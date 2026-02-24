<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\Pengajuan;
use App\Models\Mahasiswa;
use App\Models\DokUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function index()
    {
        $beasiswas = Beasiswa::all();
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        
        $pengajuanTerbaru = null;
        if ($mahasiswa) {
            $pengajuanTerbaru = Pengajuan::where('mhs_id', $mahasiswa->id)
                ->with('beasiswa')
                ->latest()
                ->first();
        }

        return view('mahasiswa.dashboard', compact('beasiswas', 'pengajuanTerbaru'));
    }

    public function profil()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        return view('mahasiswa.profil', compact('mahasiswa'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'jurusan' => 'required|string',
            'semester' => 'required|integer|min:1|max:14',
            'ipk' => 'required|numeric|between:0,4.00',
            'no_hp' => 'required|string|max:15',
        ]);

        Mahasiswa::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->only(['nim', 'nama_lengkap', 'jurusan', 'semester', 'ipk', 'no_hp'])
        );

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Profil berhasil diperbarui!');
    }

    public function detail($id)
    {
        $beasiswa = Beasiswa::with('syaratDok')->findOrFail($id);
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        
        if (!$mahasiswa || empty($mahasiswa->nim)) {
            return redirect()->route('mahasiswa.profil')
                ->with('error', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        $sudahDaftar = Pengajuan::where('mhs_id', $mahasiswa->id)
            ->where('beasiswa_id', $id)
            ->exists();

        return view('mahasiswa.detail', compact('beasiswa', 'sudahDaftar', 'mahasiswa'));
    }

    /**
     */
    public function store(Request $request)
    {
        $request->validate([
            'beasiswa_id' => 'required|exists:beasiswa,id', 
            'dokumen' => 'required|array', 
            'dokumen.*' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $cekPendaftaran = Pengajuan::where('mhs_id', $mahasiswa->id)
                ->where('beasiswa_id', $request->beasiswa_id)
                ->exists();

        if ($cekPendaftaran) {
            return redirect()->route('mahasiswa.riwayat')->with('error', 'Anda sudah mendaftar.');
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
                    $fileName = 'DOC_' . time() . '_' . $syaratId . '.' . $file->getClientOriginalExtension();
                    
                    $file->move(public_path('uploads/dokumen'), $fileName);

                    DokUpload::create([
                        'pengajuan_id'  => $pengajuan->id,
                        'syarat_dok_id' => $syaratId,
                        'nama_file'     => $fileName, 
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('mahasiswa.riwayat')->with('success', 'Pendaftaran Berhasil Terkirim!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function riwayat()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        if (!$mahasiswa) return redirect()->route('mahasiswa.dashboard');

        $pengajuans = Pengajuan::where('mhs_id', $mahasiswa->id)
            ->with(['beasiswa', 'dokUploads'])
            ->latest()
            ->get();

        return view('mahasiswa.riwayat', compact('pengajuans'));
    }
}