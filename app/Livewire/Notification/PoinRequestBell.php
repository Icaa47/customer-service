<?php

namespace App\Livewire\Notification;

use App\Models\PoinRequest;
use Illuminate\Support\Collection;
use Livewire\Component;

class PoinRequestBell extends Component
{
    public Collection $pendingRequests;
    public int $pendingCount = 0;

    protected $listeners = ['refreshBell' => 'loadRequests'];

    public function mount()
    {
        $this->loadRequests();
    }

    public function loadRequests()
    {
        if (auth()->user()->hasRole('Head Admin')) {
            $this->pendingRequests = PoinRequest::where('status', 'pending')
                ->with('requester', 'user')
                ->latest()
                ->get();
            $this->pendingCount = $this->pendingRequests->count();
        } else {
            $this->pendingRequests = collect();
            $this->pendingCount = 0;
        }
    }

    public function approve(int $requestId)
    {
        $request = PoinRequest::find($requestId);
        if ($request) {
            $request->status = 'approved';
            $request->save();
            $this->loadRequests(); // Refresh
        }
    }

    public function reject(int $requestId)
    {
        $request = PoinRequest::find($requestId);
        if ($request) {
            $request->status = 'rejected';
            $request->save();
            $this->loadRequests(); // Refresh
        }
    }

    public function render()
    {
        return view('livewire.notification.poin-request-bell');
    }
}                                                                                                                                       