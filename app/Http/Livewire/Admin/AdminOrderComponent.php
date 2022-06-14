<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminOrderComponent extends Component
{

    public function render()
    {
        $orders = Order::all();

        return view('livewire.admin.admin-order-component',compact('orders'))->layout('layouts.base-a');
    }


    public function updateOrderStatus($order_id,$status)
    {
        $order = Order::find($order_id);
        $order->status = $status;
        if ($status == "delivered") 
        {
            $order->delivered_date = DB::raw('CURRENT_DATE');
        }
        else if($status == "canceled")
        {
            $order->canceled_date = DB::raw('CURRENT_DATE');
            
        }
        $order->save();
        $this->emit('orderUpdate');
    }
}
