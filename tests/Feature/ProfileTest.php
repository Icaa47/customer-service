<?php

namespace Tests\Feature;

use App\Livewire\Profile\Edit as ProfileEdit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(ProfileEdit::class)
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->call('updateProfile')
            ->assertHasNoErrors();

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(ProfileEdit::class)
            ->set('name', 'Test User')
            ->set('email', $user->email)
            ->call('updateProfile')
            ->assertHasNoErrors();

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_password_can_be_updated(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(ProfileEdit::class)
            ->set('passwordForm.current_password', 'password')
            ->set('passwordForm.password', 'new-password')
            ->set('passwordForm.password_confirmation', 'new-password')
            ->call('updatePassword')
            ->assertHasNoErrors();

        $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(ProfileEdit::class)
            ->set('deletePassword', 'password')
            ->call('deleteAccount')
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(ProfileEdit::class)
            ->set('deletePassword', 'wrong-password')
            ->call('deleteAccount')
            ->assertHasErrors(['deletePassword']);

        $this->assertNotNull($user->fresh());
    }
}
