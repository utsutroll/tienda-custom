<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationAdmin extends Component
{
    public function markViews($id)
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->emit('render');

        return redirect()->route('admin.orderdetails', ['order_id'=> $id]); exit();
    }
    
    public function render()
    {
        return view('livewire.notification-admin');
    }
}
