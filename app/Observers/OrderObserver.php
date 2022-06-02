<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\CharacteristicProductOrder;
use App\Models\CharacteristicProduct;

class OrderObserver
{
    
    public function updating(Order $order)
    {
        if ($order->status == "canceled") 
        {
            $orderItem = CharacteristicProductOrder::where('order_id', $order->id)->get();

            foreach ($orderItem as $o) 
            {
                $product = CharacteristicProduct::find($o->characteristic_product_id);

                $stock = $product->stock + $o->quantity;
                
                CharacteristicProduct::where('id', $o->characteristic_product_id)
                        ->update(['stock' => $stock]);   
            }
        }   
    }

}
