<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $table = 'beasiswa';
    protected $fillable = ['nama', 'deskripsi', 'kuota', 'deadline'];
    /**
     */
    public function syaratDok()
    {
        return $this->hasMany(SyaratDok::class, 'beasiswa_id');
    }
    /**
     */
    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'beasiswa_id');
    }
}