<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUpdatePriceComponent extends Component
{
    public $search_pro ='';
    public $prices;
    public $product_id;
    public $entries = '10';
    public $producto;

    
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
            $this->resetPage();
    }


    public function render()
    {

        $productss = Product::where('id', 'LIKE', "%{$this->search_pro}%")
                            ->orwhere('name', 'LIKE', "%{$this->search_pro}%")
                            ->paginate($this->entries);

        return view('livewire.admin.admin-update-price-component', compact('productss'));
    }

    public function actualizar($slug)
    {
        
        /* $product =  Product::findOrFail($id); */

        $product = DB::table('products')
        ->where('slug', $slug)
        ->first();

        $this->validate([
            'prices' => "required",  
        ]);

        Product::where('slug', $product->slug)->update(['price' => $this->prices]);

        $this->reset(['prices']);

    }

}
