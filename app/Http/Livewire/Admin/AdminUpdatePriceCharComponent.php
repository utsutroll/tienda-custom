<?php

namespace App\Http\Livewire\Admin;

use App\Models\CharacteristicProduct;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUpdatePriceCharComponent extends Component
{
    public $price;
    public $searchs_pro = '';
    public $entries = '10';

    
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
            $this->resetPage();
    }

    public function render()
    {

        $products = DB::table('characteristic_product')
                        ->join('products', 'products.id', '=', 'characteristic_product.product_id')
                        ->join('brands', 'brands.id', '=', 'products.brand_id')
                        ->join('characteristics', 'characteristics.id', '=', 'characteristic_product.characteristic_id')
                        ->select(
                            DB::raw("CONCAT(products.name,' ',brands.name,' ',characteristics.name) as producto"),
                            'characteristic_product.id as id',
                            'characteristic_product.price as price',

                        )
                        ->where('products.name', 'LIKE', "%{$this->searchs_pro}%")
                        ->orWhere('brands.name', 'LIKE', "%{$this->searchs_pro}%")
                        ->orWhere('characteristics.name', 'LIKE', "%{$this->searchs_pro}%")
                        ->paginate($this->entries);


        return view('livewire.admin.admin-update-price-char-component', compact('products'));
    }


    public function update($id)
    {
        $product = CharacteristicProduct::find($id);

        $this->validate([
            'price' => "required",  
        ]);

        CharacteristicProduct::where('id', $product->id)->update(['price' => $this->price]);

        $this->reset(['price']);


    }
}
