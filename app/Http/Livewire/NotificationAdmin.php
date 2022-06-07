<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationAdmin extends Component
{
    public function markViews()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->emit('render');
    }
    
    public function render()
    {
        return view('livewire.notification-admin');
    }
}
