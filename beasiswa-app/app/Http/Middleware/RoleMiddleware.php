<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Ambil role_id user dari database (contoh: 1 atau 4)
        $userRoleId = Auth::user()->role_id;

        // 3. Cek apakah role_id user ada dalam daftar yang diizinkan di route
        if (!in_array($userRoleId, $roles)) {
            abort(403, 'AKSES DITOLAK: ANDA TIDAK MEMILIKI WEWENANG.');
        }

        return $next($request);
    }
}