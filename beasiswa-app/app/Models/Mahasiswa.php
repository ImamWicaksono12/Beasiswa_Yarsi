<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    
    // Kita gunakan dua-duanya agar Laravel tidak punya alasan memblokir user_id
    protected $guarded = []; 
    protected $fillable = ['user_id', 'prodi_id', 'nim', 'nama', 'angkatan', 'no_hp'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}