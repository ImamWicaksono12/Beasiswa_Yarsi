<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogsAppr extends Model
{
    protected $table = 'logs_appr';
    protected $fillable = ['pengajuan_id', 'approver_id', 'status', 'tanggal'];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}