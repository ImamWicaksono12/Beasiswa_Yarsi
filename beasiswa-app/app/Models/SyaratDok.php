<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyaratDok extends Model
{
    protected $table = 'syarat_dok'; // Pastikan sesuai nama tabel di migrasi
    protected $fillable = ['beasiswa_id', 'nama_dokumen'];

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}