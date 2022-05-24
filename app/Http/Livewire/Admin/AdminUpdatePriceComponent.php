<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\CharacteristicProduct;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUpdatePriceComponent extends Component
{
    public $search ='';
    public $search_pro ='';
    public $price;
    public $prices;
    public $product_id;
    public $entries = '10';
    public $producto;
    public $nombre = '';
    public $precio;

    
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
            $this->resetPage();
    }


    public function render()
    {

        $products = CharacteristicProduct::all();

        $productss = Product::where('name', 'LIKE', "%{$this->search_pro}%")
                            ->paginate($this->entries);

        return view('livewire.admin.admin-update-price-component', compact('productss', 'products'));
    }

    public function update($id)
    {
        $product = CharacteristicProduct::find($id);

        $this->validate([
            'price' => "required",  
        ]);

        CharacteristicProduct::where('id', $product->id)->update(['price' => $this->price]);

        $this->reset(['price']);
        $this->reset(['nombre']);
        $this->reset(['precio']);
        $this->reset(['product_id']);


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

    public function buscar()
    {
        $p = CharacteristicProduct::find($this->producto);
        $this->nombre = $p->product->name.' '.$p->product->presentation->name.' '.$p->product->brand->name.' '.$p->characteristic->name;
        $this->precio = $p->price;
        $this->product_id = $p->id;

    }

}
