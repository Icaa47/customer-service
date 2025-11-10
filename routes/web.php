<?php

use App\Livewire\AkunCs\Create as AkunCsCreate;
use App\Livewire\AkunCs\Index as AkunCsIndex;
use App\Livewire\Dashboard;
use App\Livewire\Pengaturan\Index as PengaturanIndex;
use App\Livewire\Rekapan\Create as RekapanCreate;
use App\Livewire\Profile\Edit as ProfileEdit;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class)->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:Head Admin|Admin|Super Admin'])->group(function () {
    Route::get('/akun-cs', AkunCsIndex::class)->name('akun-cs.index');
});

Route::get('/akun-cs/create', AkunCsCreate::class)
    ->middleware(['auth', 'role:Head Admin|Super Admin'])
    ->name('akun-cs.create');

Route::get('/pengaturan', PengaturanIndex::class)
    ->middleware('auth')
    ->name('pengaturan.index');

Route::get('/rekapan', App\Livewire\Rekapan\Index::class)->middleware(['auth'])->name('rekapan.index');
Route::get('/rekapan/create', RekapanCreate::class)->middleware('auth')->name('rekapan.create');

<<<<<<< HEAD


<<<<<<< HEAD
Route::middleware('auth')->group(function () {
    Route::get('/profile', ProfileEdit::class)->name('profile.edit');
});

=======
>>>>>>> 1ca3dab88bbf4d0c77f8a540d9979eeee0227112
=======
>>>>>>> 1ca3dab88bbf4d0c77f8a540d9979eeee0227112
require __DIR__ . '/auth.php';
