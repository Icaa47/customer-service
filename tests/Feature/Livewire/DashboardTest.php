<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Dashboard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_dashboard_route(): void
    {
        $this->get(route('dashboard'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_render_dashboard_component(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSeeTextInOrder([
                'Total Closingan',
                'Total Pendapatan',
                'Customer Baru',
                'CS Aktif',
                'Rekapan Closingan Terbaru',
                'Performa CS',
            ]);

        Livewire::test(Dashboard::class)
            ->assertStatus(200);
    }
}
