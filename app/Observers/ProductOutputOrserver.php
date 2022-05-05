<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductOutput;

class ProductOutputOrserver
{

    public function created(ProductOutput $productEntry)
    {
        $product = Product::find($productEntry->product_id);

        $stock = $product->stock - $productEntry->quantity;
        
        Product::where('id', $productEntry->product_id)
                ->update(['stock' => $stock]);
    }
    
}
