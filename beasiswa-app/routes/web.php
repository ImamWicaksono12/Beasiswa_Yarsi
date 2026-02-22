<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Tambahkan ini agar Auth bisa digunakan di rute
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BeasiswaController as AdminBeasiswaController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- PENYELAMAT 404: Rute Dashboard Utama ---
    // Rute ini menangani tombol "Dashboard" agar tidak lagi 404
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role_id == 1) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role_id == 4) {
            return redirect()->route('mahasiswa.dashboard');
        }
        return redirect('/');
    })->name('dashboard');

    // --- PROFILE (Semua Role) ---
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // --- MAHASISWA (Role ID: 4) ---
    Route::middleware(['role:4'])->prefix('mahasiswa')->group(function () {
        Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
        Route::get('/beasiswa/{id}', [MahasiswaController::class, 'detail'])->name('mahasiswa.beasiswa.detail');
        Route::post('/daftar', [MahasiswaController::class, 'store'])->name('mahasiswa.daftar');
        Route::get('/riwayat', [MahasiswaController::class, 'riwayat'])->name('mahasiswa.riwayat');
    });

    // --- ADMIN (Role ID: 1) ---
    Route::middleware(['role:1'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        Route::controller(AdminController::class)->group(function () {
            Route::get('/users', 'userIndex')->name('admin.users.index');
            Route::post('/users', 'storeUser')->name('admin.users.store');
            Route::delete('/users/{id}', 'destroyUser')->name('admin.users.destroy');
            Route::get('/monev', 'monevIndex')->name('admin.monev.index');
            Route::post('/monev/{id}/approve', 'approve')->name('admin.monev.approve');
        });

        Route::resource('beasiswa', AdminBeasiswaController::class)->names('admin.beasiswa');
    });
});

require __DIR__.'/auth.php';