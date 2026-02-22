<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void 
{
    // 1. Buat User Admin
    \App\Models\User::create([
        'role_id' => 1, 
        'username' => 'admin_pusat',
        'email' => 'admin@mail.com',
        'password' => bcrypt('password'),
    ]);

    // 2. Buat User Mahasiswa (Budi)
    $userMhs = \App\Models\User::create([
        'role_id' => 4, 
        'username' => 'mhs_budi',
        'email' => 'budi@mail.com',
        'password' => bcrypt('password'),
        ]);

    }
}
