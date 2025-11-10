<?php

namespace App\Livewire\AkunCs;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Create extends Component
{
    public string $name = '';

    public string $email = '';

    public string $role = '';

    public string $passwordPreview = '';

    /**
     * Daftar role yang tersedia untuk pemilihan pada form.
     *
     * @var array<int, string>
     */
    public array $availableRoles = [
        'Admin',
        'Head Admin',
        'Super Admin',
    ];

    public function mount(): void
    {
        $this->role = $this->availableRoles[0];
        $this->passwordPreview = Str::password(12);
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', Rule::unique(User::class, 'email')],
            'role' => ['required', Rule::in($this->availableRoles)],
        ];
    }

    public function regeneratePassword(): void
    {
        $this->passwordPreview = Str::password(12);
    }

    public function save(): void
    {
        $validated = $this->validate();

        $password = $this->passwordPreview;

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($password),
        ]);

        $user->assignRole($validated['role']);

        session()->flash(
            'status',
            sprintf(
                'Akun %s berhasil dibuat. Password sementara: %s',
                $user->name,
                $password,
            ),
        );

        $this->reset(['name', 'email']);
        $this->role = $this->availableRoles[0];
        $this->passwordPreview = Str::password(12);
    }

    public function render()
    {
        return view('livewire.akun-cs.create');
    }
}
