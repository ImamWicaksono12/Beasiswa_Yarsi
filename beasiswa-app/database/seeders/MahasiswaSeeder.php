<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run(): void {
    $user = \App\Models\User::where('email', 'budi@mail.com')->first();

    if ($user) {
        \App\Models\Mahasiswa::create([
            'user_id'  => $user->id,
            'nim'      => '2024001',
            'nama'     => 'Budi Santoso',
            'prodi_id' => 1,
            'angkatan' => '2024',
            'no_hp'    => '0812345678',
        ]);
    }
}
}