<?php

namespace App\Observers;

use App\Models\CharacteristicProduct;
use App\Models\CharacteristicProductEntry;

class ProductEntryOrserver
{

    public function created(CharacteristicProductEntry $productEntry)
    {
        $product = CharacteristicProduct::find($productEntry->characteristic_product_id);

        $stock = $product->stock + $productEntry->quantity;
        
        CharacteristicProduct::where('id', $productEntry->characteristic_product_id)
                ->update(['stock' => $stock]);
    }

}
