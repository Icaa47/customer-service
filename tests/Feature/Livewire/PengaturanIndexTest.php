<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Pengaturan\Index as PengaturanIndex;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PengaturanIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_pengaturan_route(): void
    {
        $this->get(route('pengaturan.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_render_pengaturan_component(): void
    {
        $user = User::factory()->create();

        Setting::factory()->boolean()->create([
            'section' => 'data_management',
            'section_label' => 'Manajemen Data',
            'key' => 'allow_data_export',
            'label' => 'Izinkan Ekspor Data',
            'value' => true,
        ]);

        $this->actingAs($user);

        $this->get(route('pengaturan.index'))
            ->assertOk()
            ->assertSee('Manajemen Data');

        Livewire::test(PengaturanIndex::class)
            ->assertStatus(200)
            ->assertViewIs('livewire.pengaturan.index')
            ->assertSee('Izinkan Ekspor Data');
    }

    public function test_settings_can_be_updated_in_real_time(): void
    {
        $user = User::factory()->create();

        $booleanSetting = Setting::factory()->boolean()->create([
            'section' => 'data_management',
            'section_label' => 'Manajemen Data',
            'key' => 'allow_data_import',
            'label' => 'Izinkan Impor Data',
            'value' => true,
        ]);

        $urlSetting = Setting::factory()->url()->create([
            'section' => 'support',
            'section_label' => 'Bantuan',
            'key' => 'help_center_url',
            'label' => 'Pusat Bantuan',
            'value' => 'https://contoh.id/help',
        ]);

        $this->actingAs($user);

        Livewire::test(PengaturanIndex::class)
            ->set('form.' . $booleanSetting->key, false)
            ->set('form.' . $urlSetting->key, 'https://example.com/help-center')
            ->assertSet('form.' . $booleanSetting->key, false)
            ->assertSet('form.' . $urlSetting->key, 'https://example.com/help-center');

        $this->assertDatabaseHas('settings', [
            'id' => $booleanSetting->id,
            'value' => '0',
        ]);

        $this->assertDatabaseHas('settings', [
            'id' => $urlSetting->id,
            'value' => 'https://example.com/help-center',
        ]);
    }
}
