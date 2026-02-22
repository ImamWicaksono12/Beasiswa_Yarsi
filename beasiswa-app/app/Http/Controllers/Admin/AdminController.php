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
     * DASHBOARD UTAMA
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
     */
    public function dataBeasiswa()
    {
        $beasiswas = Beasiswa::withCount('pengajuans')->latest()->get();
        return view('admin.beasiswa.index', compact('beasiswas'));
    }

    public function storeBeasiswa(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
            'periode' => 'required|string|max:50',
            'deskripsi' => 'nullable|string'
        ]);

        Beasiswa::create($validated);

        return redirect()->back()->with('success', 'Beasiswa baru berhasil ditambahkan!');
    }

    public function editBeasiswa($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        return view('admin.beasiswa.edit', compact('beasiswa'));
    }

    public function updateBeasiswa(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
            'periode' => 'required|string|max:50',
            'deskripsi' => 'nullable|string'
        ]);

        $beasiswa = Beasiswa::findOrFail($id);
        $beasiswa->update($validated);

        return redirect()->route('admin.beasiswa.index')->with('success', 'Data beasiswa berhasil diperbarui!');
    }

    public function destroyBeasiswa($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        
        if ($beasiswa->pengajuans()->exists()) {
            return redirect()->back()->with('error', 'Gagal: Program ini sudah memiliki pendaftar dan tidak bisa dihapus.');
        }

        $beasiswa->delete();
        return redirect()->route('admin.beasiswa.index')->with('success', 'Program beasiswa telah dihapus.');
    }

    /**
     */
    public function userIndex()
    {
        $users = User::where('role_id', '!=', 4)->orderBy('role_id', 'asc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id'  => 'required|in:1,2,3',
        ]);

        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $request->role_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Akun Pejabat Berhasil Terdaftar!');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Keamanan: Anda tidak diperbolehkan menghapus akun yang sedang digunakan.');
        }
        
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Akun pejabat telah dihapus.');
    }

    /**
     * MONEV
     */
    public function monevIndex()
    {
        $pendaftars = Pengajuan::with(['mahasiswa', 'beasiswa'])->latest()->get();
        return view('admin.monev.index', compact('pendaftars'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diterima,Ditolak'
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update(['status' => $request->status]);

        return back()->with('success', 'Status pendaftar berhasil diperbarui!');
    }
}