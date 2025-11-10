<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $headAdmin = User::firstOrCreate(
            ["email" => "head@vodeco.co.id"],
            [
                "name" => "Head Admin",
                "password" => Hash::make("password"),
            ],
        );
        $headAdmin->assignRole("Head Admin");

        $superAdmin = User::firstOrCreate(
            ["email" => "super@vodeco.co.id"],
            [
                "name" => "Super Admin",
                "password" => Hash::make("password"),
            ],
        );
        $superAdmin->assignRole("Super Admin");

        $admin = User::firstOrCreate(
            ["email" => "admin@vodeco.co.id"],
            [
                "name" => "Admin",
                "password" => Hash::make("password"),
            ],
        );
        $admin->assignRole("Admin");
    }
}
