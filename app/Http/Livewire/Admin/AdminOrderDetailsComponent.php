<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\ApprovedPaymentMail;
use App\Notifications\ApprovePaymentNotification;
use Livewire\Component;
use Illuminate\Support\Facades\DB as FacadesDB;

class AdminOrderDetailsComponent extends Component
{
    public $order_id;
    public $observation;

    public function mount($order_id)
    {
        $this->order_id= $order_id;
    }

    public function approvePayment()
    {

        $transaction = Transaction::where('order_id',$this->order_id);

        $transaction->update([
            'status' => "approved",
            'observation' => $this->observation,
        ]);

        $order = Order::find($this->order_id);
        $user = User::find($order->user_id);
        $user->notify(new ApprovePaymentNotification($order));
        
        $this->emit('orderUpdateA');  
    }
    public function declinedPayment()
    {

        $transaction = Transaction::where('order_id',$this->order_id);

        $transaction->update([
            'status' => "declined"
        ]);
        
        $transaction->update([
            'observation' => $this->observation
        ]);

        $order = Order::find($this->order_id);
        $user = User::find($order->user_id);
        

        $order->canceled_date = FacadesDB::raw('CURRENT_DATE');
        $order->save();

        $user->notify(new ApprovePaymentNotification($order));
        $user->notify(new ApprovedPaymentMail($order)); 
        $this->emit('orderUpdateC');   
    }

    public function render()
    {
        $order = Order::find($this->order_id);
        $user = User::find($order->user_id);
        return view('livewire.admin.admin-order-details-component', ['order' => $order, 'user' => $user])->layout('layouts.base-a');
    }
}
