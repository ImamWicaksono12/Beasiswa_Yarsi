<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokUpload extends Model
{
    protected $table = 'dok_upload';
    protected $fillable = ['pengajuan_id', 'nama_file'];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}