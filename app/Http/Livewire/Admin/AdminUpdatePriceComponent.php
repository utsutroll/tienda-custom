<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
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

        $productss = Product::where('name', 'LIKE', "%{$this->search_pro}%")
                            ->paginate($this->entries);

        return view('livewire.admin.admin-update-price-component', compact('productss'));
    }

    public function actualizar($id)
    {
        $product = Product::find($id);

        $this->validate([
            'prices' => "required",  
        ]);

        Product::where('id', $product->id)->update(['price' => $this->prices]);

        $this->reset(['prices']);

    }

}
