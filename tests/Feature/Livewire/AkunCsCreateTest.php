<?php

namespace Tests\Feature\Livewire;

use App\Livewire\AkunCs\Create as AkunCsCreate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AkunCsCreateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::findOrCreate('Admin');
        Role::findOrCreate('Head Admin');
        Role::findOrCreate('Super Admin');
    }

    public function test_authorized_user_can_view_create_component(): void
    {
        $viewer = User::factory()->create();
        $viewer->assignRole('Super Admin');

        $this->actingAs($viewer);

        $component = Livewire::test(AkunCsCreate::class)
            ->assertStatus(200);

        $password = $component->instance()->passwordPreview;

        $this->assertNotEmpty($password);
        $this->assertSame(12, strlen($password));
    }

    public function test_regenerate_password_creates_new_value(): void
    {
        $viewer = User::factory()->create();
        $viewer->assignRole('Head Admin');

        $this->actingAs($viewer);

        $component = Livewire::test(AkunCsCreate::class);

        $initialPassword = $component->instance()->passwordPreview;

        $component->call('regeneratePassword');

        $regenerated = $component->instance()->passwordPreview;

        $this->assertNotSame($initialPassword, $regenerated);
        $this->assertSame(12, strlen($regenerated));
    }

    public function test_save_creates_user_with_role_and_hashed_password(): void
    {
        $viewer = User::factory()->create();
        $viewer->assignRole('Super Admin');

        $this->actingAs($viewer);

        $component = Livewire::test(AkunCsCreate::class)
            ->set('name', 'CS Baru')
            ->set('email', 'cs.baru@example.com')
            ->set('role', 'Admin');

        $generatedPassword = $component->instance()->passwordPreview;

        $component->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('users', [
            'email' => 'cs.baru@example.com',
            'name' => 'CS Baru',
        ]);

        $createdUser = User::where('email', 'cs.baru@example.com')->first();

        $this->assertNotNull($createdUser);
        $this->assertTrue(Hash::check($generatedPassword, $createdUser->password));
        $this->assertTrue($createdUser->hasRole('Admin'));
    }

    public function test_user_without_required_role_cannot_access_route(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Admin');

        $this->actingAs($user);

        $this->get(route('akun-cs.create'))
            ->assertForbidden();
    }
}
