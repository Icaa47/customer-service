# Vodeco Customer Service

![Vodeco Customer Service](public/images/customer-support.png)

Aplikasi Customer Service yang dibangun menggunakan Laravel untuk membantu mengelola interaksi dengan pelanggan secara efisien.

## Fitur

- Autentikasi Pengguna (Login, Register)
- Manajemen Profil Pengguna
- Dashboard untuk Customer Service
- Manajemen Role dan Permission
- Komponen interaktif berbasis Livewire untuk alur kerja customer service
- Kompilasi aset modern menggunakan Vite (Tailwind CSS, Alpine.js, dan Livewire)

## Prasyarat

Pastikan lingkungan pengembangan Anda memenuhi persyaratan berikut:

- PHP >= 8.2
- Composer
- Node.js & NPM
- Database (MySQL, PostgreSQL, atau SQLite)

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek secara lokal:

1.  **Clone repository:**
    ```bash
    git clone <URL_REPOSITORY_ANDA>
    cd customer-service
    ```

2.  **Install dependensi PHP:**
    ```bash
    composer install
    ```

3.  **Buat file `.env`:**
    Salin file `.env.example` menjadi `.env`.
    ```bash
    cp .env.example .env
    ```
    Sesuaikan konfigurasi database (DB_DATABASE, DB_USERNAME, DB_PASSWORD) di dalam file `.env` Anda.

4.  **Generate application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan migrasi database:**
    Ini akan membuat tabel-tabel yang diperlukan di database Anda.
    ```bash
    php artisan migrate
    ```

6.  **Jalankan database seeder:**
    Ini akan mengisi tabel database dengan data awal, seperti role dan user.
    ```bash
    php artisan db:seed
    ```

7.  **Install dependensi JavaScript:**
    ```bash
    npm install
    ```

8.  **Buat symlink storage (opsional namun direkomendasikan):**
    ```bash
    php artisan storage:link
    ```

9.  **Siapkan Livewire & Vite:**
    Pastikan variabel Vite pada `.env` sesuai dengan URL dev server (default: `http://localhost:5173`).
    ```env
    VITE_APP_NAME="Customer Service"
    VITE_DEV_SERVER_URL="http://localhost:5173"
    ```

## Pengembangan

Untuk pengalaman pengembangan Livewire + Vite yang optimal, jalankan perintah berikut pada terminal terpisah:

```bash
# Menjalankan server Laravel
php artisan serve

# Menjalankan dev server Vite & watcher Tailwind
npm run dev

# (Opsional) Memantau antrian Livewire/broadcast
php artisan queue:listen
```

- Aplikasi akan tersedia di `http://127.0.0.1:8000`.
- Vite akan memantau perubahan pada file CSS, JavaScript, dan komponen Livewire Anda.
- Untuk membuat komponen Livewire baru, gunakan `php artisan livewire:make Ticket/DetailPanel` lalu impor komponen pada view terkait.

## Menjalankan Tes

Untuk menjalankan rangkaian tes otomatis (PHPUnit), gunakan perintah berikut:

```bash
php artisan test
```

Untuk menguji interaksi Livewire secara manual, Anda juga dapat menjalankan komponen tertentu menggunakan `php artisan livewire:discover` untuk memastikan komponen terdeteksi setelah penambahan baru.

## Deployment

Berikut adalah panduan umum untuk mendeploy aplikasi ke server produksi:

1.  **Clone repository** di server Anda.
2.  **Install dependensi** dengan mode produksi:
    ```bash
    composer install --no-dev --optimize-autoloader
    npm install
    ```
3.  **Buat file `.env`** dan sesuaikan dengan konfigurasi produksi Anda.
4.  **Generate application key:**
    ```bash
    php artisan key:generate
    ```
5.  **Jalankan migrasi database:**
    ```bash
    php artisan migrate --force
    ```
6.  **Build aset frontend:**
    ```bash
    npm run build
    ```
7.  **Optimasi Konfigurasi:**
    Cache konfigurasi, route, dan view untuk meningkatkan performa.
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```
8.  **Atur Web Server:**
    Konfigurasikan web server Anda (misalnya Nginx atau Apache) untuk mengarahkan root dokumen ke direktori `public` proyek.
9.  **Atur Supervisor:**
    Konfigurasikan Supervisor untuk menjalankan proses antrian (`php artisan queue:work`) secara terus-menerus di latar belakang.

10. **Konfigurasi Livewire + Vite di produksi:**
    Pastikan variabel berikut sudah diatur pada `.env` produksi Anda agar aset Livewire termuat dengan benar.
    ```env
    APP_URL="https://app.example.com"
    ASSET_URL="https://cdn.example.com" # opsional bila memakai CDN
    LIVEWIRE_URL="https://app.example.com"
    ```

## Catatan Tambahan

- Jalankan `npm run build` ulang setiap kali ada perubahan pada aset Vite sebelum melakukan deploy.
- Gunakan `php artisan optimize:clear` bila menemui masalah cache saat mengembangkan komponen Livewire baru.
- Dokumentasi Livewire resmi: [https://livewire.laravel.com/](https://livewire.laravel.com/).

## Kontribusi

Terima kasih atas minat Anda untuk berkontribusi! Untuk menjaga stabilitas dan keteraturan proyek, mohon perhatikan alur kerja berikut:

- **Jangan melakukan *commit* langsung ke branch `main` atau `develop`.**
- Selalu buat **branch baru** dari branch `develop` untuk setiap fitur atau perbaikan yang Anda kerjakan.
- Gunakan nama branch yang deskriptif (misalnya, `feature/login-page` atau `fix/user-bug`).
- Setelah selesai, ajukan *Pull Request* ke branch `develop`.