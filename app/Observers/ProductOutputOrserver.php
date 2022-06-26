<?php

namespace App\Observers;

use App\Models\CharacteristicProduct;
use App\Models\CharacteristicProductOutput;
use App\Models\Product;

class ProductOutputOrserver
{

    public function created(CharacteristicProductOutput $productEntry)
    {
        $product = CharacteristicProduct::find($productEntry->characteristic_product_id);

        $stock = $product->stock - $productEntry->quantity;
        
        CharacteristicProduct::where('id', $productEntry->characteristic_product_id)
                ->update(['stock' => $stock]);
        
        Product::where('id', $product->product_id)
                ->update(['stock' => $stock]);
    }
    
}
