<?php

namespace App\Observers;

use App\Models\CharacteristicProduct;
use App\Models\CharacteristicProductEntry;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductEntryOrserver
{

    public function created(CharacteristicProductEntry $productEntry)
    {
        $product = CharacteristicProduct::find($productEntry->characteristic_product_id);

        $stock = $product->stock + $productEntry->quantity;
        
        $charact = CharacteristicProduct::where('id', $productEntry->characteristic_product_id);
        $charact->update(['stock' => $stock]);

        $stock_max = DB::table('characteristic_product')
                        ->where('product_id', '=', $product->product_id)
                        ->sum('stock');

        Product::where('id', $product->product_id)
                ->update(['stock' => $stock_max]);
    }

}
