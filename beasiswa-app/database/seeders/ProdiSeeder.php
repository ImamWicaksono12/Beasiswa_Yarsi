<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
    $prodis = [
        ['nama_prodi' => 'Teknik Informatika', 'fakultas' => 'Teknik'],
        ['nama_prodi' => 'Sistem Informasi', 'fakultas' => 'Teknik'],
        ['nama_prodi' => 'Manajemen', 'fakultas' => 'Ekonomi'],
    ];
    foreach ($prodis as $p) {
        \App\Models\Prodi::create($p);
    }
}
}
