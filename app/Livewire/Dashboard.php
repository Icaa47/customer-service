<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $closingHarian = 0;
    public $closingBulanan = 0;
    public $rekapitulasi = '0';
    public $search = '';

    #[Layout('layouts.app')]
    public function render()
    {
        // Dummy data for closings
        $closingsData = new Collection([
            ['klien' => 'Klien A', 'bisnis' => 'Bisnis A', 'produk' => 'Produk 1', 'jumlah' => 10, 'waktu' => '2025-10-22', 'status' => 'Selesai'],
            ['klien' => 'Klien B', 'bisnis' => 'Bisnis B', 'produk' => 'Produk 2', 'jumlah' => 5, 'waktu' => '2025-10-22', 'status' => 'Pending'],
        ]);

        // Manual pagination for closings
        $closings = new LengthAwarePaginator(
            $closingsData->forPage($this->getPage('closingPage'), 5),
            $closingsData->count(),
            5,
            $this->getPage('closingPage'),
            ['pageName' => 'closingPage']
        );

        // Fetch users with search
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->paginate(5, ['*'], 'userPage');

        return view('overview.index', [
            'closings' => $closings,
            'users' => $users,
        ]);
    }
}
