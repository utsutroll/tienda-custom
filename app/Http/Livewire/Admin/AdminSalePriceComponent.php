<?php

namespace App\Http\Livewire\Admin;

use App\Models\CharacteristicProduct;
use Livewire\Component;

class AdminSalePriceComponent extends Component
{
    /* Variables */
    public $product;
    public $nombre = '';
    public $precio;
    public $sale_precio;
    public $price;
    public $product_id;

    /* End Variables */

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $ssproducts = CharacteristicProduct::all();

        return view('livewire.admin.admin-sale-price-component', compact('ssproducts'))->layout('layouts.base-a');
    }

    public function buscar()
    {
        $p = CharacteristicProduct::find($this->product);
        $this->nombre = $p->product->name.' '.$p->product->brand->name.' '.$p->characteristic->name;
        $this->precio = $p->price;
        $this->sale_precio = $p->sale_price;
        $this->product_id = $p->id;

    }

    public function update($id)
    {
        $product = CharacteristicProduct::find($id);

        $this->validate([
            'price' => "required",  
        ]);

        CharacteristicProduct::where('id', $product->id)->update(['sale_price' => $this->price]);

        $this->reset(['price']);
        $this->reset(['nombre']);
        $this->reset(['precio']);
        $this->reset(['product_id']);
        $this->emit('render');

    } 
}
