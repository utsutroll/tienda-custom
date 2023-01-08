<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    protected $listeners = ['render' => 'render'];

    public function markViews($id, $route)
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->emit('render');

        return redirect()->route($route, ['order_id'=> $id]); exit();
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
