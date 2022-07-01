<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\CharacteristicProduct;
use Illuminate\Support\Facades\Storage;

class ProductOrserver
{

    public function created(Product $product)
    {
        //
    }

    public function deleting(Product $product)
    {
        $charact = CharacteristicProduct::where('product_id', '=', $product->id);
            
            foreach ($charact as  $c) {

                Storage::disk('public')->delete($c->image);

            }
    }

}
