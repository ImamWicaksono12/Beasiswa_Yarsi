<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi (Login).
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Ambil user yang login
        $user = Auth::user();

        // Redirect berdasarkan role_id agar mahasiswa tidak error
        if ($user->role_id == 1) {
            // Admin Pusat
            return redirect()->intended(route('admin.dashboard'));
        } elseif ($user->role_id == 4) {
            // Mahasiswa (mhs_budi)
            return redirect()->intended(route('mahasiswa.dashboard'));
        }

        /**
         * SOLUSI ALTERNATIF: 
         * Menggunakan URL langsung '/admin/dashboard' untuk menghindari error 
         * 'Undefined type RouteServiceProvider' di VS Code Anda.
         */
        return redirect()->intended('/admin/dashboard');
    }

    /**
     * Hapus session (Logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}