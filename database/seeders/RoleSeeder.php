<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ini adalah sintaks yang benar, menggunakan string, bukan array
        Role::findOrCreate("Head Admin");
        Role::findOrCreate("Super Admin");
        Role::findOrCreate("Admin");
    }
}
