# Layout & Livewire Dependency Guide

Panduan ini menjelaskan keterkaitan antara layout Blade di `resources/views/layouts` dengan komponen Livewire pada `app/Livewire`. Tujuannya agar pengembang baru memahami bagaimana tampilan dasar, navigasi, dan sidebar saling terhubung dengan komponen halaman.

## Ringkasan Arsitektur

- **Layout utama:** `resources/views/layouts/app.blade.php`.
  - Menyediakan struktur HTML dasar, wrapper konten, serta memuat partial `sidebar` dan `navigation`.
  - Mendaftarkan store Alpine bernama `layout` yang menyimpan status `sidebarOpen` dan menyediakan metode `toggleSidebar`, `openSidebar`, serta `closeSidebar`.
  - Menginisialisasi komponen Alpine `layoutRoot()` yang:
    - Menjaga sinkronisasi status sidebar dengan lebar viewport (otomatis membuka pada layar ≥768px dan menutup pada layar kecil).
    - Menyediakan metode `closeOnMobile()` untuk menutup sidebar hanya pada perangkat mobile (digunakan oleh overlay dan event `@click.away`).
    - Menyediakan helper `mainWrapperClasses()` yang mengatur margin konten utama agar menyesuaikan lebar sidebar.
  - Menambahkan overlay (`div` dengan `md:hidden`) agar interaksi di perangkat mobile tetap fokus ketika sidebar terbuka.

- **Partial navigasi atas:** `resources/views/layouts/navigation.blade.php`.
  - Memiliki state lokal Alpine (`open`) untuk menu responsif di ukuran layar kecil.
  - Tombol hamburger memanggil `$store.layout.toggleSidebar()` untuk mengatur sidebar.
  - Menampilkan judul halaman otomatis berdasarkan segmen URL, serta menu profil pengguna.

- **Partial sidebar:** `resources/views/layouts/sidebar.blade.php`.
  - Menggunakan `$store.layout.sidebarOpen` untuk menampilkan/menyembunyikan sidebar dengan transisi.
  - Memanggil `closeOnMobile()` (dari `layoutRoot`) saat klik di luar area sidebar sehingga hanya menutup pada perangkat mobile.
  - Menyediakan link utama aplikasi dengan state aktif berdasarkan route saat ini.

## Komponen Livewire

Semua komponen Livewire halaman memanfaatkan layout `layouts.app` agar mendapatkan struktur dan perilaku di atas.

| Komponen | File PHP | View | Cara menetapkan layout |
| --- | --- | --- | --- |
| Dashboard | `app/Livewire/Dashboard.php` | `resources/views/dashboard/index.blade.php` | `->layout('layouts.app')` dalam metode `render()` |
| Akun CS | `app/Livewire/AkunCs/Index.php` | `resources/views/livewire/akun-cs/index.blade.php` | `->layout('layouts.app')` dalam metode `render()` |
| Rekapan | `app/Livewire/Rekapan/Index.php` | `resources/views/livewire/rekapan/index.blade.php` | Atribut `#[Layout('layouts.app')]` |
| Pengaturan | `app/Livewire/Pengaturan/Index.php` | `resources/views/livewire/pengaturan/index.blade.php` | Atribut `#[Layout('layouts.app')]` |

> **Catatan:** Ketika menambahkan komponen Livewire baru, pastikan view menggunakan layout `layouts.app` agar otomatis memperoleh sidebar, topbar, dan binding store Alpine.

## Alur Interaksi Sidebar & Topbar

1. Pengguna menekan tombol hamburger pada topbar (`navigation.blade.php`).
2. Tombol memanggil `$store.layout.toggleSidebar()` sehingga nilai `sidebarOpen` berubah.
3. `sidebar.blade.php` merespons perubahan tersebut dengan transisi tampil/sembunyi.
4. Wrapper konten utama (`layoutRoot.mainWrapperClasses()`) menyesuaikan margin sehingga ruang konten tetap proporsional.
5. Pada perangkat mobile, overlay akan muncul dan klik di luar sidebar memanggil `closeOnMobile()` untuk menutupnya.

Dengan memahami alur di atas, penambahan fitur baru di sekitar navigasi dapat mengikuti pola yang sama tanpa harus mengulang logika pengelolaan state.
