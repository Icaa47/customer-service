<?php

namespace App\Livewire\AkunCs;

use App\Models\Closing;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Index extends Component
{
    public float $targetPoin = 14.0;
    public Collection $users;
    public ?User $user = null;
    public bool $isLoading = false;
    public ?int $selectedUserId = null;

    /**
     * @var array<int, string>
     */
    protected array $chartLabels = [];

    protected Collection $chartPeriod;

    /**
     * Menyiapkan data awal untuk komponen.
     */
    public function mount(): void
    {
        $this->users = collect();
        $this->rebuildUsers();
    }

    public function render(): View
    {
        return view("livewire.akun-cs.index")->layout("layouts.app");
    }

    public function toggleActive(int $userId): void
    {
        if (!auth()->user()?->hasRole("Head Admin")) {
            throw new AuthorizationException();
        }

        if ($userId <= 0) {
            return;
        }

        $this->isLoading = true;

        try {
            $user = User::role(["Super Admin", "Admin"])->findOrFail($userId);

            $user->is_active = ! (bool) $user->is_active;
            $user->save();

            $this->rebuildUsers();
        } finally {
            $this->isLoading = false;
        }
    }

    // protected function rebuildUsers(): void
    // {
    //     $current = now();
    //     $periodStart = $current->copy()->subDays(6)->startOfDay();
    //     $periodEnd = $current->copy()->endOfDay();

    //     $this->chartPeriod = collect(range(6, 0))->map(
    //         fn(int $day) => $current->copy()->subDays($day)->startOfDay(),
    //     );

    //     $this->chartLabels = $this->chartPeriod
    //         ->map(fn(Carbon $date) => $this->formatDayLabel($date))
    //         ->toArray();

    //     if (auth()->user()->hasRole('Head Admin')) {
    //         $users = User::role(["Super Admin", "Admin"])
    //             ->with("roles")
    //             ->withCount([
    //                 "closings as closing_total" => fn($query) => $query
    //                     ->where("status", "Selesai")
    //                     ->whereBetween("created_at", [$periodStart, $periodEnd]),
    //                 "closings as waiting_total" => fn($query) => $query->where(
    //                     "status",
    //                     "Pending",
    //                 ),
    //             ])
    //             ->withSum(
    //                 [
    //                     "closings as poin_total" => fn($query) => $query
    //                         ->where("status", "Selesai")
    //                         ->whereBetween("created_at", [
    //                             $periodStart,
    //                             $periodEnd,
    //                         ]),
    //                 ],
    //                 "poin",
    //             )
    //             ->get();
    //     } else {

    //         $user = User::role(["Super Admin", "Admin"])
    //             ->where('id', auth()->id()) // <--- Filter ID
    //             ->with("roles")
    //             ->withCount([
    //                 "closings as closing_total" => $closingsCountQuery,
    //                 "closings as waiting_total" => $waitingCountQuery,
    //             ])
    //             ->withSum(
    //                 ["closings as poin_total" => $poinSumQuery],
    //                 "poin",
    //             )
    //             ->first(); // <--- Ambil satu

    //         $historyByUser = collect();
    //         if ($user) {
    //             $historyByUser = $historyQuery(collect([$user->id]));
    //         }

    //         // 3. Proses dan isi $this->user (objek tunggal)
    //         $this->user = $user ? $this->addCalculatedDataToUser($user, $historyByUser) : null;
    //         $this->users = collect(); // Pastikan koleksi user kosong
    //     }





    //     $historyByUser = Closing::query()
    //         ->selectRaw(
    //             "user_id, DATE(created_at) as closing_date, " .
    //                 "COUNT(*) as closing_total, COALESCE(SUM(poin), 0) as poin_total",
    //         )
    //         ->where("status", "Selesai")
    //         ->whereBetween("created_at", [$periodStart, $periodEnd])
    //         ->whereIn("user_id", $users->pluck("id"))
    //         ->groupBy("user_id", "closing_date")
    //         ->orderBy("closing_date")
    //         ->get()
    //         ->groupBy("user_id");

    //     $this->users = $users->map(function (User $user) use (
    //         $historyByUser,
    //     ) {
    //         $history = $historyByUser->get($user->id, collect());

    //         $chartValues = $this->generateChartValues(
    //             $this->chartPeriod,
    //             $history,
    //         );
    //         $chartMeta = $this->buildChartMeta($chartValues);

    //         /**
    //          * KOREKSI 3: Menggunakan nilai dari query, bukan array_sum
    //          */
    //         $closing = (int) ($user->closing_total ?? 0);
    //         $poin = round((float) ($user->poin_total ?? 0), 1);
    //         $waitingList = (int) ($user->waiting_total ?? 0);

    //         $user->kode_cs = "CS-" . str_pad($user->id, 3, "0", STR_PAD_LEFT);
    //         $user->closing = $closing;
    //         $user->poin = $poin;
    //         $user->waitingList = $waitingList;

    //         $percentage =
    //             $this->targetPoin > 0
    //             ? max(0, min(100, ($user->poin / $this->targetPoin) * 100))
    //             : 0;

    //         $user->poinPercentage = $percentage;
    //         $user->poinColorHue = $percentage * 1.2;
    //         $user->poinDifference = $user->poin - $this->targetPoin;
    //         $user->chart = $chartMeta;

    //         return $user;
    //     });
    // }

    protected function addCalculatedDataToUser(User $user, Collection $historyByUser): User
    {
        $history = $historyByUser->get($user->id, collect());

        $chartValues = $this->generateChartValues(
            $this->chartPeriod,
            $history,
        );
        $chartMeta = $this->buildChartMeta($chartValues);

        $closing = (int) ($user->closing_total ?? 0);
        $poin = round((float) ($user->poin_total ?? 0), 1);
        $waitingList = (int) ($user->waiting_total ?? 0);

        $user->kode_cs = "CS-" . str_pad($user->id, 3, "0", STR_PAD_LEFT);
        $user->closing = $closing;
        $user->poin = $poin;
        $user->waitingList = $waitingList;

        $percentage =
            $this->targetPoin > 0
            ? max(0, min(100, ($user->poin / $this->targetPoin) * 100))
            : 0;

        $user->poinPercentage = $percentage;
        $user->poinColorHue = $percentage * 1.2;
        $user->poinDifference = $user->poin - $this->targetPoin;
        $user->chart = $chartMeta;

        return $user;
    }

    protected function rebuildUsers(): void
    {
        $current = now();
        $periodStart = $current->copy()->subDays(6)->startOfDay();
        $periodEnd = $current->copy()->endOfDay();

        $this->chartPeriod = collect(range(6, 0))->map(
            fn(int $day) => $current->copy()->subDays($day)->startOfDay(),
        );

        $this->chartLabels = $this->chartPeriod
            ->map(fn(Carbon $date) => $this->formatDayLabel($date))
            ->toArray();

        // Definisikan query umum agar tidak duplikat
        $closingsCountQuery = fn($query) => $query
            ->where("status", "Selesai")
            ->whereBetween("created_at", [$periodStart, $periodEnd]);

        $waitingCountQuery = fn($query) => $query->where("status", "Pending");

        $poinSumQuery = fn($query) => $query
            ->where("status", "Selesai")
            ->whereBetween("created_at", [$periodStart, $periodEnd]);

        // Query untuk data histori
        $historyQuery = fn(Collection $userIds) => Closing::query()
            ->selectRaw(
                "user_id, DATE(created_at) as closing_date, " .
                    "COUNT(*) as closing_total, COALESCE(SUM(poin), 0) as poin_total",
            )
            ->where("status", "Selesai")
            ->whereBetween("created_at", [$periodStart, $periodEnd])
            ->whereIn("user_id", $userIds) // <--- Dinamis
            ->groupBy("user_id", "closing_date")
            ->orderBy("closing_date")
            ->get()
            ->groupBy("user_id");

        // --- LOGIKA UTAMA BERDASARKAN ROLE ---

        if (auth()->user()->hasRole(['Head Admin', 'Super Admin'])) {

            // 1. Ambil SEMUA user
            $users = User::role(["Super Admin", "Admin"])
                ->with("roles")
                ->withCount([
                    "closings as closing_total" => $closingsCountQuery,
                    "closings as waiting_total" => $waitingCountQuery,
                ])
                ->withSum(
                    ["closings as poin_total" => $poinSumQuery],
                    "poin",
                )
                ->get();

            // 2. Ambil histori untuk SEMUA user
            $historyByUser = $historyQuery($users->pluck("id"));

            // 3. Proses dan isi $this->users (koleksi)
            $this->users = $users->map(fn(User $u) => $this->addCalculatedDataToUser($u, $historyByUser));
            $this->user = null; // Pastikan user tunggal kosong

        } else {

            // 1. Ambil SATU user (yang sedang login)
            $user = User::role("Admin")
                ->where('id', auth()->id()) // <--- Filter ID
                ->with("roles")
                ->withCount([
                    "closings as closing_total" => $closingsCountQuery,
                    "closings as waiting_total" => $waitingCountQuery,
                ])
                ->withSum(
                    ["closings as poin_total" => $poinSumQuery],
                    "poin",
                )
                ->first(); // <--- Ambil satu

            // 2. Ambil histori HANYA untuk user ini
            $historyByUser = collect();
            if ($user) {
                $historyByUser = $historyQuery(collect([$user->id]));
            }

            // 3. Proses dan isi $this->user (objek tunggal)
            $this->user = $user ? $this->addCalculatedDataToUser($user, $historyByUser) : null;
            $this->users = collect(); // Pastikan koleksi user kosong
        }
    }

    public function updateRole(int $userId, string $role): void
    {
        if (!auth()->user()?->hasRole("Head Admin")) {
            throw new AuthorizationException();
        }

        $normalizedRole = trim($role);

        if (!in_array($normalizedRole, ["Admin", "Super Admin"], true)) {
            throw ValidationException::withMessages([
                "role" => __("Role tidak valid."),
            ]);
        }

        if ($userId <= 0) {
            throw ValidationException::withMessages([
                "user" => __("Pengguna tidak valid."),
            ]);
        }

        $this->isLoading = true;

        try {
            $user = User::role(["Super Admin", "Admin"])->findOrFail($userId);

            if ($user->hasRole($normalizedRole)) {
                return;
            }

            $user->syncRoles([$normalizedRole]);

            $this->rebuildUsers();
        } finally {
            $this->isLoading = false;
        }
    }

    protected function generateChartValues(
        Collection $period,
        Collection $history,
    ): array {
        $historyTotals = $history->mapWithKeys(function ($row) {
            $dateString = $row->closing_date ?? null;

            if (!$dateString) {
                return [];
            }

            $date = Carbon::parse($dateString);

            return [$date->toDateString() => (int) ($row->closing_total ?? 0)];
        });

        return $period
            ->map(
                fn(Carbon $date) => $historyTotals->get(
                    $date->toDateString(),
                    0,
                ),
            )
            ->toArray();
    }

    /**
     * KOREKSI 2: Mengembalikan nilai max/min yang asli
     */
    protected function buildChartMeta(array $values): array
    {
        $width = 360;
        $height = 160;
        $paddingX = 24;
        $paddingY = 18;

        $originalMax = max($values); // Simpan nilai asli
        $originalMin = min($values); // Simpan nilai asli

        $max = $originalMax; // Salin untuk dimodifikasi
        $min = $originalMin; // Salin untuk dimodifikasi

        if ($max === $min) {
            $max += 1;
            $min = max(0, $min - 1);
        }

        $range = max(1, $max - $min);
        $pointCount = count($values);
        $stepX =
            $pointCount > 1 ? ($width - $paddingX * 2) / ($pointCount - 1) : 0;

        $points = [];

        foreach ($values as $index => $value) {
            $x = $paddingX + $stepX * $index;
            $normalized = ($value - $min) / $range;
            $y = $height - $paddingY - $normalized * ($height - $paddingY * 2);

            $points[] = [
                "x" => round($x, 2),
                "y" => round($y, 2),
                "value" => $value,
            ];
        }

        $firstPoint = $points[0] ?? [
            "x" => $paddingX,
            "y" => $height - $paddingY,
        ];
        $lastPoint = $points[count($points) - 1] ?? $firstPoint;

        $segments = array_map(
            fn(array $point) => $point["x"] . "," . $point["y"],
            $points,
        );

        $path = "M " . implode(" L ", $segments);
        $area =
            $path .
            " L " .
            $lastPoint["x"] .
            "," .
            ($height - $paddingY) .
            " L " .
            $firstPoint["x"] .
            "," .
            ($height - $paddingY) .
            " Z";

        return [
            "values" => $values,
            "labels" => $this->chartLabels,
            "path" => $path,
            "area" => $area,
            "points" => $points,
            "width" => $width,
            "height" => $height,
            "max" => $max,
            "min" => $min,
            "average" => round(array_sum($values) / max(1, count($values)), 1),
        ];
    }

    protected function formatDayLabel(Carbon $date): string
    {
        $map = [
            "Mon" => "Sen",
            "Tue" => "Sel",
            "Wed" => "Rab",
            "Thu" => "Kam",
            "Fri" => "Jum",
            "Sat" => "Sab",
            "Sun" => "Min",
        ];

        $abbr = $date->format("D");

        return $map[$abbr] ?? $abbr;
    }
}
