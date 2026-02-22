<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengajuan extends Model
{
    protected $table = 'pengajuan'; // Pastikan nama tabel sesuai database Anda
    protected $fillable = ['user_id', 'beasiswa_id', 'status', 'keterangan'];

    // Relasi ke User (Mahasiswa)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Beasiswa
    public function beasiswa(): BelongsTo
    {
        return $this->belongsTo(Beasiswa::class, 'beasiswa_id');
    }
}