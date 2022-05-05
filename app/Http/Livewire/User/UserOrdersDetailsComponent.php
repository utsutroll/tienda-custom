<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserOrdersDetailsComponent extends Component
{
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function cancelOrder()
    {
        $order = Order::find($this->order_id);
        $order->status == "canceled";
        $order->canceled_date = DB::raw('CURRENT_DATE');
        $order->save();  
        $this->emit('orderUpdate');  
    }
    
    public function render()
    {
        $order = Order::where('user_id',Auth::user()->id)
                        ->where('id',$this->order_id)->first();

        return view('livewire.user.user-orders-details-component',['order'=>$order])->layout('layouts.base');
    }
}
