<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderObserver
{
    
    public function updating(Order $order)
    {
        if ($order->status == "canceled") 
        {
            $orderItem = OrderItem::where('order_id', $order->id)->get();

            foreach ($orderItem as $o) 
            {
                $product = Product::find($o->product_id);

                $stock = $product->stock + $o->quantity;
                
                Product::where('id', $o->product_id)
                        ->update(['stock' => $stock]);   
            }
        }   
    }

}