<?php

namespace App\Observers;

use App\Models\CharacteristicProductOrder;
use App\Models\CharacteristicProduct;

class OrderItemObserver
{
    
    public function created(CharacteristicProductOrder $orderItem)
    {
        $product = CharacteristicProduct::find($orderItem->characteristic_product_id);

        $stock = $product->stock - $orderItem->quantity;
        
        CharacteristicProduct::where('id', $orderItem->product_id)
                ->update(['stock' => $stock]);
    }
   
}
