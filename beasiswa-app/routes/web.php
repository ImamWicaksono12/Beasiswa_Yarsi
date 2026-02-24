<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\mahasiswa\MahasiswaController;
use App\Http\Controllers\Admin\AdminController;

// 1. Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// 2. Grup Route yang Memerlukan Login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Alur Redirect Dashboard Sesuai Role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role_id == 1) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role_id == 4) {
            return redirect()->route('mahasiswa.dashboard');
        }
        return redirect('/');
    })->name('dashboard');

    // Profile Default Laravel (Breeze)
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // --- MAHASISWA (Role ID: 4) ---
    Route::middleware(['role:4'])->prefix('mahasiswa')->group(function () {
        Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
        Route::get('/beasiswa/{id}', [MahasiswaController::class, 'detail'])->name('mahasiswa.beasiswa.detail');
        Route::post('/daftar', [MahasiswaController::class, 'store'])->name('mahasiswa.daftar.store');
        Route::get('/riwayat', [MahasiswaController::class, 'riwayat'])->name('mahasiswa.riwayat');
        
        // Fitur Profil Mahasiswa
        Route::get('/profil', [MahasiswaController::class, 'profil'])->name('mahasiswa.profil');
        Route::post('/profil/update', [MahasiswaController::class, 'updateProfil'])->name('mahasiswa.profil.update');
    });

    // --- ADMIN (Role ID: 1) ---
    Route::middleware(['role:1'])->prefix('admin')->group(function () {
        // Dashboard Utama Admin
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        Route::controller(AdminController::class)->group(function () {
            // Manajemen Akun Pejabat (Admin/Pimpinan)
            Route::get('/users', 'userIndex')->name('admin.users.index');
            Route::post('/users', 'storeUser')->name('admin.users.store');
            Route::delete('/users/{id}', 'destroyUser')->name('admin.users.destroy');
            
            // --- MANAJEMEN MONITORING (MONEV) ---
            Route::get('/monev', 'monevIndex')->name('admin.monev.index');
            // Rute ini yang dipanggil di form Blade Admin (update status terima/tolak)
            Route::post('/monev/update-status/{id}', 'updateStatus')->name('admin.updateStatus');
            // Backup rute patch jika diperlukan
            Route::patch('/monev/{id}/update', 'updateStatus')->name('admin.monev.update');

            // --- MANAJEMEN DATA BEASISWA ---
            Route::get('/beasiswa', 'dataBeasiswa')->name('admin.beasiswa.index'); 
            Route::post('/beasiswa/store', 'storeBeasiswa')->name('admin.beasiswa.store'); 
            Route::get('/beasiswa/{id}/edit', 'editBeasiswa')->name('admin.beasiswa.edit'); 
            Route::patch('/beasiswa/{id}/update', 'updateBeasiswa')->name('admin.beasiswa.update'); 
            Route::delete('/beasiswa/{id}', 'destroyBeasiswa')->name('admin.beasiswa.destroy'); 
        });
    });
});

require __DIR__.'/auth.php';