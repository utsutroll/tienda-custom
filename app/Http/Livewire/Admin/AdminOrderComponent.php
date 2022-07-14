<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminOrderComponent extends Component
{

    public $pendding;

    protected $queryString = ['pendding'];

    public function render()
    {   
        if ($this->pendding == 'pendiente') {
            $orders = DB::table('orders')
                        ->join('transactions', 'transactions.order_id', '=', 'orders.id')
                        ->select(
                            'orders.id as id',
                            'orders.firstname as firstname',
                            'orders.lastname as lastname',
                            'orders.mobile as mobile',
                            'orders.total as total',
                            'orders.total_bs as total_bs',
                            'orders.status as status',
                            'orders.created_at as created_at',
                            'transactions.status as status_pago')
                        ->where('orders.status', 'ordered')
                        ->get();
        }else {
            $orders = DB::table('orders')
                    ->join('transactions', 'transactions.order_id', '=', 'orders.id')
                    ->select(
                        'orders.id as id',
                        'orders.firstname as firstname',
                        'orders.lastname as lastname',
                        'orders.mobile as mobile',
                        'orders.total as total',
                        'orders.total_bs as total_bs',
                        'orders.status as status',
                        'orders.created_at as created_at',
                        'transactions.status as status_pago')
                    ->get();
        }

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
