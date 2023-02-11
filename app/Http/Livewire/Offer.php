<?php

namespace App\Http\Livewire;


use App\Models\CharacteristicProduct;
use App\Models\DollarRate;
use App\Models\Sale;
use App\Models\Slider;
use Livewire\Component;
use Cart;


class Offer extends Component
{
    

    public function render()
    {   
        $dollar = DollarRate::all(); 
        $sliders = Slider::all();
        
        $sproducts = CharacteristicProduct::all()->where('sale_price', '>', 0)->take(8);
        
        if($sproducts->count() < 0)
        {
            $this->sproducts = null;
        }

        $sale = Sale::find(1);

        return view('livewire.offer', compact('sproducts', 'sale', 'dollar', 'sliders'))->layout('layouts.base');
    }

    public function store($product_id, $product_name, $product_price)
    {   
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\CharacteristicProduct');

        $this->emit('cartAdded');
        $this->emit('alert', 'El producto se agregó al carrito de compras con éxito.');
    }

    public function destroy($rowId)
    {
        foreach(Cart::instance('cart')->content() as $citem)
        {

            if ($citem->id == $rowId) {

                Cart::instance('cart')->remove($citem->rowId);

                $this->emit('cartRemoved');
                $this->emit('alert', 'El producto se eliminó del carrito de compras con éxito.');
                
                return;
            }
        }
    }

}
