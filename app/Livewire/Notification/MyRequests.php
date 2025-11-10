<?php

namespace App\Livewire\Notification;

use App\Models\PoinRequest;
use Illuminate\Support\Collection;
use Livewire\Component;

class MyRequests extends Component
{
    public Collection $myRequests;
    public int $unreadCount = 0;

    public function mount()
    {
        $this->loadRequests();
    }

    public function loadRequests()
    {
        if (auth()->user()->hasRole('Super Admin')) {
            $this->myRequests = PoinRequest::where('requester_id', auth()->id())
                ->whereIn('status', ['approved', 'rejected'])
                ->with('user')
                ->latest()
                ->get();

            $this->unreadCount = PoinRequest::where('requester_id', auth()->id())
                ->whereIn('status', ['approved', 'rejected'])
                ->whereNull('read_at')
                ->count();
        } else {
            $this->myRequests = collect();
            $this->unreadCount = 0;
        }
    }

    public function markAsRead(int $requestId)
    {
        $request = PoinRequest::find($requestId);
        if ($request && $request->requester_id === auth()->id()) {
            $request->read_at = now();
            $request->save();
            $this->loadRequests(); // Refresh
        }
    }

    public function render()
    {
        return view('livewire.notification.my-requests');
    }
}
