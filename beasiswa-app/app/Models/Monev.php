<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monev extends Model
{
    protected $table = 'monev';
    protected $fillable = ['mhs_id', 'semester', 'ipk'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mhs_id');
    }
}