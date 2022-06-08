<?php

namespace App\Http\Livewire\Admin;

use App\Models\CharacteristicProduct;
use Livewire\Component;

class AdminUpdatePriceCharComponent extends Component
{
    public $price;
    public $product_id;
    public $producto;
    public $nombre = '';
    public $precio;

    public function render()
    {
        $products = CharacteristicProduct::all();

        return view('livewire.admin.admin-update-price-char-component', compact('products'));
    }

    public function buscar()
    {
        $p = CharacteristicProduct::find($this->producto);
        $this->nombre = $p->product->name.' '.$p->product->brand->name.' '.$p->characteristic->name;
        $this->precio = $p->price;
        $this->product_id = $p->id;

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
}
