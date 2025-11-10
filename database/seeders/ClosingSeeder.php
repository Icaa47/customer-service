<?php

namespace Database\Seeders;

use App\Models\Closing;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClosingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role(["Super Admin", "Admin"])->get();

        if ($users->isEmpty()) {
            $this->command->info(
                "Tidak ada user Super Admin atau Admin. Harap jalankan UserSeeder terlebih dahulu.",
            );
            return;
        }

        $klienList = [
            "PT Alabama",
            "PT Surya",
            "PT Lorem",
            "PT Ipsum",
            "PT Dolor",
            "PT Sit Amet",
            "CV Maju Jaya",
            "UD Berkah",
            "Toko Sejahtera",
            "Warung Ibu",
        ];
        $produkList = ["Website", "Compro", "SEO", "Custom", "Landing Page"];
        $paketList = ["Basic", "Standard", "Premium", "Enterprise"];
        $statusList = ["Selesai", "Pending", "Gagal"];

        for ($i = 0; $i < 50; $i++) {
            $user = $users->random();
            $status = $statusList[array_rand($statusList)];
            $jumlah = rand(1, 10) * 500000;

            Closing::create([
                "user_id" => $user->id,
                "klien" => $klienList[array_rand($klienList)],
                "bisnis" => "Bisnis",
                "paket" => $paketList[array_rand($paketList)],
                "produk" => $produkList[array_rand($produkList)],
                "jumlah" => $jumlah,
                "poin" =>
                    $status == "Selesai" ? round($jumlah / 1000000, 2) : 0, // Poin = 1 per 1jt jika selesai
                "status" => $status,
                "created_at" => now()->subDays(rand(0, 30)),
            ]);
        }
    }
}
