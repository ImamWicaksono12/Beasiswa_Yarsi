<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $table = 'ranking';
    protected $fillable = ['pengajuan_id', 'nilai', 'peringkat'];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}