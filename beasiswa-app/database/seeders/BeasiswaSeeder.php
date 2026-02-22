<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
    \App\Models\Beasiswa::create([
        'nama' => 'Beasiswa Prestasi 2026',
        'kuota' => 50,
        'periode' => '2026/2027'
    ]);
}
}
