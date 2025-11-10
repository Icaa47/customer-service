<?php

namespace App\Livewire\Rekapan;

use App\Models\Closing;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Number;

#[Layout("layouts.app")]
class Index extends Component
{
    use WithPagination;

    public float $closingHarian = 0;
    public float $closingBulanan = 0;
    public string $rekapitulasi = "Rp. 0 Jt";

    /**
     * mount() dijalankan saat komponen dimuat.
     * Kita isi datanya di sini.
     */
    public function mount()
    {
        $this->closingHarian = Closing::where("status", "Selesai")
            ->whereDate("created_at", today())
            ->count();

        $this->closingBulanan = Closing::where("status", "Selesai")
            ->whereMonth("created_at", now()->month)
            ->whereYear("created_at", now()->year)
            ->count();

        $totalRekap = Closing::where("status", "Selesai")
            ->whereMonth("created_at", now()->month)
            ->whereYear("created_at", now()->year)
            ->sum("jumlah");

        $this->rekapitulasi = 'Rp. ' . $this->formatRekapitulasi($totalRekap) . ' Jt';
    }

    /**
     * Fungsi render() akan menampilkan view
     */
    public function render()
    {
        $closings = Closing::latest()->paginate(7);

        return view("livewire.rekapan.index", [
            "closings" => $closings,
        ]);
    }

    private function formatRekapitulasi(float $totalRekap): string
    {
        $nilaiJuta = $totalRekap / 1000000;

        if (extension_loaded("intl")) {
            return Number::format($nilaiJuta, 1);
        }

        return number_format($nilaiJuta, 1, ",", ".");
    }
}
