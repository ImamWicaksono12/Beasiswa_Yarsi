<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $roles = ['Admin', 'Kaprodi', 'Wadek', 'Mahasiswa'];
        foreach ($roles as $r) {
            \App\Models\Role::create(['name' => $r]);
    }
}


}
