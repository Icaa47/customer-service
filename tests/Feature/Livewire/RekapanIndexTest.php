<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Rekapan\Index as RekapanIndex;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RekapanIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_rekapan_route(): void
    {
        $this->get(route('rekapan.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_render_rekapan_component(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->get(route('rekapan.index'))
            ->assertOk()
            ->assertSee('Detail Closingan');

        Livewire::test(RekapanIndex::class)
            ->assertStatus(200)
            ->assertViewIs('livewire.rekapan.index');
    }
}
