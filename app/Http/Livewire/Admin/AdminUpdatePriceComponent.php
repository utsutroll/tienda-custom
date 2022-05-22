<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\CharacteristicProduct;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUpdatePriceComponent extends Component
{
    public $category;
    public $search ='';
    public $price;
    public $product_id;
    
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
            $this->resetPage();
    }


    public function render()
    {
        $categories = Category::all();

        $products = CharacteristicProduct::paginate(10);

        return view('livewire.admin.admin-update-price-component', compact('categories', 'products'));
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
