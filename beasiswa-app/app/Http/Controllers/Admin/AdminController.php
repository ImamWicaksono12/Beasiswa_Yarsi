<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Dashboard Utama
     * Menghilangkan error 'Internal Server Error' dan 'Undefined variable $recentApplications'
     */
    public function index()
    {
        // Mengambil data pengajuan terbaru agar variabel di view terisi
        $recentApplications = Pengajuan::with(['user', 'beasiswa'])->latest()->take(5)->get();
        return view('admin.dashboard', compact('recentApplications'));
    }

    /**
     * Manajemen User (Halaman Indeks)
     * Menampilkan daftar pejabat di tabel sebelah kanan
     */
    public function userIndex()
    {
        // Mengambil user selain role_id 4 (Mahasiswa) agar admin_pusat (1) dan lainnya muncul
        // Ini akan otomatis mengambil role Admin (1), Kaprodi (2), Wadek (3), dan Warek (5)
        $users = User::where('role_id', '!=', 4)->orderBy('role_id', 'asc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menyimpan Akun Pejabat Baru
     * Mendukung penambahan WAREK dan sinkron dengan kolom 'username'
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users', // Sesuai kolom DB
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id'  => 'required|integer',
        ]);

        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password untuk keamanan login
            'role_id'  => $request->role_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Akun Pejabat Berhasil Terdaftar!');
    }

    /**
     * Menghapus Akun Pejabat
     */
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        
        // Proteksi agar admin tidak menghapus dirinya sendiri saat sedang login
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Akun pejabat telah dihapus.');
    }

    /**
     * Halaman Monitoring & Monev (Placeholder)
     */
    public function monevIndex()
    {
        return view('admin.monev.index');
    }
}