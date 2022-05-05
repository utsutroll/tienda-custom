<?php

namespace App\Observers;

use App\Models\OrderItem;
use App\Models\Product;

class OrderItemObserver
{
    
    public function created(OrderItem $orderItem)
    {
        $product = Product::find($orderItem->product_id);

        $stock = $product->stock - $orderItem->quantity;
        
        Product::where('id', $orderItem->product_id)
                ->update(['stock' => $stock]);
    }
   
}
