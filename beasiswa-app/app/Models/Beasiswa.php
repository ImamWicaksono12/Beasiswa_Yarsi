<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $table = 'beasiswa';
    protected $fillable = ['nama', 'deskripsi', 'kuota', 'deadline'];


    public function syaratDok(){
        return $this->hasMany(SyaratDok::class, 'beasiswa_id');
    }
}
