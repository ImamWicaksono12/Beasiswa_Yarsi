<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokUpload extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan di database
    protected $table = 'dok_upload';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'pengajuan_id',
        'syarat_dok_id',
        'nama_file',
    ];

    /**
     * Relasi ke data Pengajuan (Induk pendaftaran)
     */
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }

    /**
     * Relasi ke SyaratDok (Untuk tahu dokumen ini jenisnya apa)
     */
    public function syarat()
    {
        // Pastikan nama modelnya SyaratDok atau sesuaikan dengan model yang kamu punya
        return $this->belongsTo(SyaratDok::class, 'syarat_dok_id');
    }
}