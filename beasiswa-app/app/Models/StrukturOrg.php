<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrg extends Model
{
    protected $table = 'struktur_org';
    protected $fillable = ['user_id', 'prodi_id', 'jabatan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}