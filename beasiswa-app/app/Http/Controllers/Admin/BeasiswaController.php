<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\SyaratDok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeasiswaController extends Controller
{
    /**
     */
    public function index()
    {
        // Mengambil beasiswa beserta jumlah pendaftarnya untuk dashboard
        $beasiswas = Beasiswa::withCount('pengajuans')->latest()->get();
        return view('admin.beasiswa.index', compact('beasiswas'));
    }

    /**
     */
    public function create()
    {
        return view('admin.beasiswa.create');
    }

    /**
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'kuota' => 'required|integer',
            'deadline' => 'required|date',
            'syarat' => 'required|array', 
        ]);

        DB::beginTransaction();
        try {
            $beasiswa = Beasiswa::create($request->only('nama', 'deskripsi', 'kuota', 'deadline'));

            foreach ($request->syarat as $nama_dokumen) {
                if ($nama_dokumen) {
                    $beasiswa->syaratDok()->create(['nama_dokumen' => $nama_dokumen]);
                }
            }

            DB::commit();
            return redirect()->route('admin.beasiswa.index')->with('success', 'Beasiswa berhasil diterbitkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     */
    public function edit($id)
    {
        $beasiswa = Beasiswa::with('syaratDok')->findOrFail($id);
        return view('admin.beasiswa.edit', compact('beasiswa'));
    }

    /**
     */
    public function update(Request $request, $id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'kuota' => 'required|integer',
            'deadline' => 'required|date',
        ]);

        $beasiswa->update($request->only('nama', 'deskripsi', 'kuota', 'deadline'));

        return redirect()->route('admin.beasiswa.index')->with('success', 'Data beasiswa berhasil diubah!');
    }

    /**
     */
    public function destroy($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        
        $beasiswa->syaratDok()->delete();
        $beasiswa->delete();

        return redirect()->route('admin.beasiswa.index')->with('success', 'Beasiswa telah dihapus.');
    }
}