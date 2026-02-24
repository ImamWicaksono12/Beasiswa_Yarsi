<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pengajuan;
use App\Models\Beasiswa; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class AdminController extends Controller
{
    /**
     */
    public function index()
    {
        $stats = [
            'total_mahasiswa' => User::where('role_id', 4)->count(),
            'total_beasiswa'  => Beasiswa::count(),
            'total_pengajuan' => Pengajuan::count(),
            'pending_review'  => Pengajuan::where('status', 'Pending')->count(),
        ];

        $chartData = [
            'data' => [
                Pengajuan::where('status', 'Diterima')->count(),
                Pengajuan::where('status', 'Pending')->count(),
                Pengajuan::where('status', 'Ditolak')->count(),
            ]
        ];

        $recentApplications = Pengajuan::with(['mahasiswa', 'beasiswa'])->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('recentApplications', 'stats', 'chartData'));
    }

    /**
     * Manajemen Program Beasiswa
     */
    public function dataBeasiswa()
    {
        $beasiswas = Beasiswa::withCount('pengajuans')->latest()->get();
        return view('admin.beasiswa.index', compact('beasiswas'));
    }

    public function storeBeasiswa(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
            'periode' => 'required|string|max:50',
            'deadline' => 'required|date',
            'deskripsi' => 'nullable|string',
            'syarat' => 'required|array|min:1',
        ]);

        DB::beginTransaction();
        try {
            $beasiswa = Beasiswa::create([
                'nama' => $request->nama,
                'kuota' => $request->kuota,
                'periode' => $request->periode,
                'deadline' => $request->deadline,
                'deskripsi' => $request->deskripsi,
            ]);

            if ($request->has('syarat')) {
                foreach ($request->syarat as $namaSyarat) {
                    if (!empty($namaSyarat)) {
                        DB::table('syarat_dok')->insert([
                            'beasiswa_id' => $beasiswa->id,
                            'nama_dokumen' => $namaSyarat,
                            'wajib' => 1,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.beasiswa.index')->with('success', 'Program Beasiswa Berhasil Diterbitkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Simpan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Manajemen Akun Pejabat (Kaprodi, Wadek, Warek)
     */
    public function userIndex() 
    { 
        // Mengambil semua user kecuali mahasiswa (role_id 4)
        $users = User::where('role_id', '!=', 4)->orderBy('role_id', 'asc')->get(); 
        return view('admin.users.index', compact('users')); 
    }
    
    public function storeUser(Request $request) 
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username', 
            'email'    => 'required|email|unique:users,email', 
            'password' => 'required|min:8', 
            'role_id'  => 'required|integer'
        ]);

        try {
            User::create([
                'username' => $request->username, 
                'email'    => $request->email, 
                'password' => Hash::make($request->password), 
                'role_id'  => $request->role_id,
                'email_verified_at' => now(),
            ]);
            return redirect()->route('admin.users.index')->with('success', 'Akun Struktural Berhasil Terdaftar!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat akun: ' . $e->getMessage());
        }
    }

    public function destroyUser($id) 
    { 
        $user = User::findOrFail($id); 
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Keamanan: Anda tidak bisa menghapus akun sendiri.'); 
        }
        $user->delete(); 
        return back()->with('success', 'Akun berhasil dihapus.'); 
    }
    
    /**
     * Monitoring & Evaluasi (Monev) Pendaftar
     */
    public function monevIndex() 
    { 
        $pendaftars = Pengajuan::with(['mahasiswa', 'beasiswa', 'dokUploads.syarat'])
            ->latest() 
            ->get(); 

        return view('admin.monev.index', compact('pendaftars')); 
    }
    
    public function updateStatus(Request $request, $id) 
    { 
        $request->validate(['status' => 'required|in:Pending,Diterima,Ditolak']); 
        
        try {
            Pengajuan::findOrFail($id)->update(['status' => $request->status]); 
            return back()->with('success', 'Status pendaftar berhasil diperbarui!'); 
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update status: ' . $e->getMessage());
        }
    }
}