<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'section' => 'account',
                'section_label' => 'Akun',
                'key' => 'profile_update_url',
                'label' => 'Ubah Profil',
                'type' => Setting::TYPE_URL,
                'value' => 'https://contoh.id/pengguna/profil',
                'description' => 'Tautan halaman pengaturan profil.',
                'metadata' => [
                    'section_description' => 'Pengaturan yang berkaitan dengan identitas dan keamanan akun.',
                    'placeholder' => 'https://contoh.id/pengguna/profil',
                ],
                'sort' => 1,
            ],
            [
                'section' => 'account',
                'section_label' => 'Akun',
                'key' => 'password_update_url',
                'label' => 'Ubah Kata Sandi',
                'type' => Setting::TYPE_URL,
                'value' => 'https://contoh.id/pengguna/password',
                'description' => 'Tautan halaman untuk mengganti kata sandi pengguna.',
                'metadata' => [
                    'placeholder' => 'https://contoh.id/pengguna/password',
                ],
                'sort' => 2,
            ],
            [
                'section' => 'data_management',
                'section_label' => 'Manajemen Data',
                'key' => 'allow_data_export',
                'label' => 'Izinkan Ekspor Data',
                'type' => Setting::TYPE_BOOLEAN,
                'value' => true,
                'description' => 'Aktifkan untuk mengizinkan admin mengekspor data closing.',
                'metadata' => [
                    'section_description' => 'Kelola akses impor dan ekspor data operasional.',
                ],
                'sort' => 1,
            ],
            [
                'section' => 'data_management',
                'section_label' => 'Manajemen Data',
                'key' => 'allow_data_import',
                'label' => 'Izinkan Impor Data',
                'type' => Setting::TYPE_BOOLEAN,
                'value' => false,
                'description' => 'Jika aktif, pengguna dapat mengunggah data closing massal.',
                'sort' => 2,
            ],
            [
                'section' => 'support',
                'section_label' => 'Bantuan',
                'key' => 'help_center_url',
                'label' => 'Pusat Bantuan',
                'type' => Setting::TYPE_URL,
                'value' => 'https://contoh.id/bantuan',
                'description' => 'Tautan menuju dokumentasi pusat bantuan.',
                'metadata' => [
                    'section_description' => 'Sumber daya untuk membantu tim customer service.',
                ],
                'sort' => 1,
            ],
            [
                'section' => 'support',
                'section_label' => 'Bantuan',
                'key' => 'support_contact_url',
                'label' => 'Hubungi Kami',
                'type' => Setting::TYPE_URL,
                'value' => 'mailto:support@contoh.id',
                'description' => 'Alamat email atau tautan kontak resmi tim support.',
                'metadata' => [
                    'placeholder' => 'mailto:support@contoh.id',
                ],
                'sort' => 2,
            ],
            [
                'section' => 'about',
                'section_label' => 'Tentang Aplikasi',
                'key' => 'application_version',
                'label' => 'Versi Aplikasi',
                'type' => Setting::TYPE_TEXT,
                'value' => '1.0.0-alpha',
                'description' => 'Informasi versi yang ditampilkan pada halaman pengaturan.',
                'metadata' => [
                    'section_description' => 'Informasi umum seputar aplikasi.',
                ],
                'sort' => 1,
            ],
            [
                'section' => 'about',
                'section_label' => 'Tentang Aplikasi',
                'key' => 'privacy_policy_url',
                'label' => 'Kebijakan Privasi',
                'type' => Setting::TYPE_URL,
                'value' => 'https://contoh.id/kebijakan-privasi',
                'description' => 'Tautan kebijakan privasi resmi.',
                'sort' => 2,
            ],
            [
                'section' => 'about',
                'section_label' => 'Tentang Aplikasi',
                'key' => 'terms_conditions_url',
                'label' => 'Syarat & Ketentuan',
                'type' => Setting::TYPE_URL,
                'value' => 'https://contoh.id/syarat-ketentuan',
                'description' => 'Tautan syarat dan ketentuan penggunaan aplikasi.',
                'sort' => 3,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting,
            );
        }
    }
}
