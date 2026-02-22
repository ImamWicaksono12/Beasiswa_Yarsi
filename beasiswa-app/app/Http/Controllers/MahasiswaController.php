<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\Pengajuan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function index()
    {
        $beasiswas = Beasiswa::all();
        return view('mahasiswa.dashboard', compact('beasiswas'));
    }

    public function detail($id)
    {
        $beasiswa = Beasiswa::with('syaratDok')->findOrFail($id);
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $sudahDaftar = false;
        
        if ($mahasiswa) {
            $sudahDaftar = Pengajuan::where('mhs_id', $mahasiswa->id)
                                    ->where('beasiswa_id', $id)
                                    ->exists();
        }

        return view('mahasiswa.detail', compact('beasiswa', 'sudahDaftar'));
    }

    public function store(Request $request)
    {
        // PERBAIKAN 1: 'dokumen' diganti menjadi 'nullable' 
        // agar tidak error jika beasiswa memang tidak meminta file (seperti di image_79a320.jpg)
        $request->validate([
            'beasiswa_id' => 'required|exists:beasiswa,id', 
            'dokumen' => 'nullable|array', 
            'dokumen.*' => 'file|mimes:pdf,jpg,png|max:2048',
        ]);

        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Profil mahasiswa tidak ditemukan.');
        }

        // PERBAIKAN 2: Proteksi ganda agar tidak bisa daftar ulang jika sudah ada di riwayat
        $cekPendaftaran = Pengajuan::where('mhs_id', $mahasiswa->id)
                                    ->where('beasiswa_id', $request->beasiswa_id)
                                    ->exists();

        if ($cekPendaftaran) {
            return redirect()->route('mahasiswa.riwayat')->with('error', 'Anda sudah terdaftar di beasiswa ini.');
        }

        DB::beginTransaction();
        try {
            $pengajuan = Pengajuan::create([
                'mhs_id'      => $mahasiswa->id, 
                'beasiswa_id' => $request->beasiswa_id,
                'tanggal'     => now(),
                'status'      => 'Pending',
            ]);

            if ($request->hasFile('dokumen')) {
                foreach ($request->file('dokumen') as $syaratId => $file) {
                    $fileName = 'SCH_' . $pengajuan->id . '_' . $syaratId . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('dokumen_pendaftaran', $fileName, 'public');
                }
            }

            DB::commit();
            // Redirect ke riwayat agar Budi tahu pendaftarannya masuk
            return redirect()->route('mahasiswa.riwayat')->with('success', 'Pendaftaran Berhasil!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function riwayat()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Profil tidak ditemukan.');
        }

        $pengajuans = Pengajuan::where('mhs_id', $mahasiswa->id)
                                ->with('beasiswa')
                                ->latest()
                                ->get();

        return view('mahasiswa.riwayat', compact('pengajuans'));
    }
}