<?php

namespace App\Livewire;

// Hapus use App\Models\User jika tidak digunakan langsung di sini
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator; // Impor Paginator
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str; // Impor Str untuk search

class Dashboard extends Component
{
    use WithPagination;

    // --- Data Kartu ---
    public $closingHarian = 5;      // Data dummy untuk kartu
    public $closingBulanan = 5;     // Data dummy untuk kartu
    public $rekapitulasi = '15,4 jt'; // Data dummy untuk kartu

    // --- Data Tabel Closingan ---
    public $allClosingsData = [];

    // --- Data Tabel Performa CS ---
    public $allPerformancesData = [];
    public string $searchPerformance = ''; // Properti untuk input search Performa CS

    /**
     * mount() dijalankan saat komponen dimuat.
     * Isi data dummy di sini.
     */
    public function mount()
    {
        // Data dummy untuk Tabel Closingan
        $this->allClosingsData = [
            ['nama' => 'Ademas Wahyu', 'bisnis' => 'Bisnis', 'produk' => 'Website', 'jumlah' => 'Rp. 1.500.000', 'waktu' => '17 Maret 2025', 'status' => 'Selesai'],
            ['nama' => 'Surya Mentari', 'bisnis' => 'Bisnis', 'produk' => 'Compro', 'jumlah' => 'Rp. 1.500.000', 'waktu' => '17 Maret 2025', 'status' => 'Gagal'],
            ['nama' => 'Intan Permadi', 'bisnis' => 'Bisnis', 'produk' => 'SEO', 'jumlah' => 'Rp. 1.500.000', 'waktu' => '17 Maret 2025', 'status' => 'Selesai'],
            ['nama' => 'Dolor Sit', 'bisnis' => 'Bisnis', 'produk' => 'Compro', 'jumlah' => 'Rp. 1.500.000', 'waktu' => '17 Maret 2025', 'status' => 'Pending'],
            ['nama' => 'PT Dolor', 'bisnis' => 'Bisnis', 'produk' => 'Custom', 'jumlah' => 'Rp. 1.500.000', 'waktu' => '17 Maret 2025', 'status' => 'Selesai'],
            ['nama' => 'Amet Consectetur', 'bisnis' => 'Bisnis', 'produk' => 'Website', 'jumlah' => 'Rp. 1.500.000', 'waktu' => '17 Maret 2025', 'status' => 'Selesai'],
            ['nama' => 'Ademas Wahyu', 'bisnis' => 'Bisnis', 'produk' => 'Compro', 'jumlah' => 'Rp. 1.500.000', 'waktu' => '17 Maret 2025', 'status' => 'Selesai'],
            // Data tambahan untuk paginasi closingan
            ['nama' => 'Surya Mentari', 'bisnis' => 'Bisnis', 'produk' => 'SEO', 'jumlah' => 'Rp. 1.000.000', 'waktu' => '18 Maret 2025', 'status' => 'Selesai'],
            ['nama' => 'Intan Permadi', 'bisnis' => 'Bisnis', 'produk' => 'Website', 'jumlah' => 'Rp. 2.500.000', 'waktu' => '18 Maret 2025', 'status' => 'Pending'],
            ['nama' => 'Dolor Sit', 'bisnis' => 'Bisnis', 'produk' => 'Custom', 'jumlah' => 'Rp. 500.000', 'waktu' => '18 Maret 2025', 'status' => 'Gagal'],
        ];

        // Data dummy untuk Tabel Performa CS
        $this->allPerformancesData = [
            ['nama' => 'Ademas Wahyu', 'total_closingan' => 150, 'rata_rata_closing' => '5 / hari', 'status' => 'Aktif'],
            ['nama' => 'Surya Mentari', 'total_closingan' => 120, 'rata_rata_closing' => '4 / hari', 'status' => 'Aktif'],
            ['nama' => 'Intan Permadi', 'total_closingan' => 90, 'rata_rata_closing' => '3 / hari', 'status' => 'Tidak Aktif'],
            ['nama' => 'Dolor Sit', 'total_closingan' => 135, 'rata_rata_closing' => '4.5 / hari', 'status' => 'Aktif'],
            ['nama' => 'Amet Consectetur', 'total_closingan' => 110, 'rata_rata_closing' => '3.7 / hari', 'status' => 'Aktif'],
            // Data tambahan untuk paginasi performa
            ['nama' => 'User Enam', 'total_closingan' => 100, 'rata_rata_closing' => '3.3 / hari', 'status' => 'Aktif'],
            ['nama' => 'User Tujuh', 'total_closingan' => 80, 'rata_rata_closing' => '2.7 / hari', 'status' => 'Tidak Aktif'],
            ['nama' => 'User Delapan', 'total_closingan' => 160, 'rata_rata_closing' => '5.3 / hari', 'status' => 'Aktif'],
        ];
    }

    /**
     * Fungsi helper untuk paginasi manual dari array.
     * Menerima $pageName untuk membedakan paginator.
     */
    public function paginateManual(Collection $items, int $perPage = 5, string $pageName = 'page', ?int $page = null): LengthAwarePaginator
    {
        // Gunakan resolveCurrentPage dari Paginator untuk mendapatkan halaman saat ini
        $page = $page ?: Paginator::resolveCurrentPage($pageName);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $total = $items->count();
        $results = $items->slice(($page - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(), // Path URL saat ini
            'pageName' => $pageName,
        ]);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        // --- Proses Data Closingan ---
        // Paginate data closingan dengan nama halaman 'closingPage', 7 item per halaman
        $closings = $this->paginateManual(collect($this->allClosingsData), 7, 'closingPage');

        // --- Proses Data Performa CS ---
        // Filter data performa berdasarkan input $searchPerformance (hanya nama, case-insensitive)
        $filteredPerformances = collect($this->allPerformancesData)->filter(function ($item) {
            $searchLower = Str::lower($this->searchPerformance);
            return empty($this->searchPerformance) ||
                Str::contains(Str::lower($item['nama']), $searchLower);
        });
        // Paginate data performa yang sudah difilter dengan nama halaman 'performancePage', 5 item per halaman
        $performances = $this->paginateManual($filteredPerformances, 5, 'performancePage');

        // Kirim kedua set data (paginated) ke view 'overview.index'
        return view('overview.index', [
            'closings' => $closings,
            'performances' => $performances, // Kirim data performa
        ]);
    }

    // Fungsi ini dipanggil setiap kali $searchPerformance berubah (karena wire:model.live)
    public function updatingSearchPerformance(): void
    {
        // Reset hanya paginasi dengan nama 'performancePage' ke halaman 1
        $this->resetPage(pageName: 'performancePage');
    }
}
