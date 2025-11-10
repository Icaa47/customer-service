<?php

namespace App\Livewire\AkunCs;

use App\Models\PoinRequest;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class PoinRequestModal extends Component
{
    public bool $showModal = false;
    public ?User $user = null;
    public string $notes = '';

    #[On('openPoinRequestModal')]
    public function openModal(int $userId)
    {
        $this->user = User::find($userId);
        if ($this->user) {
            $this->showModal = true;
            $this->notes = ''; // Reset notes
        }
    }

    public function submitRequest()
    {
        if (!auth()->user()->hasRole('Super Admin') || !$this->user) {
            return; // Safety check
        }

        PoinRequest::create([
            'requester_id' => auth()->id(),
            'user_id' => $this->user->id,
            'notes' => $this->notes,
            'status' => 'pending',
        ]);

        $this->closeModal();
        // Anda bisa tambahkan dispatch notifikasi toast di sini
        // $this->dispatch('toast', 'Permintaan terkirim!');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->user = null;
    }

    public function render()
    {
        return view('livewire.akun-cs.poin-request-modal');
    }
}
