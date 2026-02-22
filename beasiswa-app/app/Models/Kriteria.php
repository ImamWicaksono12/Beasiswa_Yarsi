<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';
    protected $fillable = ['beasiswa_id', 'nama', 'bobot'];

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}