<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    protected $listeners = ['render' => 'render'];

    public function markViews()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
