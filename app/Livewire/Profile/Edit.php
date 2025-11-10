<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // 1. Tambahkan ini
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads; // 2. Tambahkan ini

class Edit extends Component
{
    use WithFileUploads; // 3. Tambahkan ini

    public User $user;
    public string $name = '';
    public string $email = '';
    public $photo = null; // 4. Tambahkan properti untuk upload

    /**
     * @var array<string, string>
     */
    public array $passwordForm = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public string $deletePassword = '';

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    #[Computed]
    public function roles(): string
    {
        return $this->user->getRoleNames()->implode(', ') ?: '-';
    }

    #[Computed]
    public function isEmailVerified(): bool
    {
        return (bool) $this->user->email_verified_at;
    }

    public function updateProfile(): void
    {
        // 5. Tambahkan 'photo' ke aturan validasi
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user->id),
            ],
            'photo' => ['nullable', 'image', 'max:1024'], // Maks 1MB
        ]);

        // 6. Logika untuk menyimpan foto baru
        if ($this->photo) {
            // Hapus foto lama jika ada
            if ($this->user->profile_photo_path) {
                Storage::disk('public')->delete($this->user->profile_photo_path);
            }
            // Simpan foto baru dan dapatkan jalurnya
            $path = $this->photo->store('profile-photos', 'public');
            // Tambahkan jalur ke data yang divalidasi
            $validated['profile_photo_path'] = $path;
        }

        $this->user->fill($validated);

        if ($this->user->isDirty('email')) {
            $this->user->email_verified_at = null;
        }

        $this->user->save();

        $this->photo = null; // 7. Reset input file setelah disimpan

        $this->name = $this->user->name;
        $this->email = $this->user->email;

        session()->flash('status', 'profile-updated');

        // 8. Kirim event untuk me-refresh foto di navigasi (jika ada)
        $this->dispatch('profile-updated', photoUrl: $this->user->profile_photo_path);
    }

    public function updatePassword(): void
    {
        // ... (Tidak ada perubahan di sini) ...
    }

    public function deleteAccount(): mixed
    {
        // ... (Tidak ada perubahan di sini) ...
    }

    public function sendVerification(): void
    {
        // ... (Tidak ada perubahan di sini) ...
    }

    public function render()
    {
        return view('livewire.profile.edit')
            ->layout('layouts.app');
    }
}
