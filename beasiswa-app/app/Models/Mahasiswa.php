<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    
    protected $guarded = []; 
    protected $fillable = ['user_id', 'prodi_id', 'nim', 'nama', 'angkatan', 'no_hp'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}