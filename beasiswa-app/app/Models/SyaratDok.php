<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyaratDok extends Model
{
    protected $table = 'syarat_dok'; 
    protected $fillable = ['beasiswa_id', 'nama_dokumen'];

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}