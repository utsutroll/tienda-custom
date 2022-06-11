<?php

namespace App\Http\Livewire;

use App\Models\CharacteristicProduct;
use App\Models\DollarRate;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Cart;
use Livewire\Component;

class DetailsComponent extends Component
{
    public $slug;
    public $qty = 1;
    public $id_product;
    public $name;
    public $price;
    

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $dollar = DollarRate::all();
        $sale = Sale::find(1);

        $product = Product::where('slug', $this->slug)->first();

        $similares = Product::where('subcategory_id', $product->subcategory_id)
                           ->where('id', '!=', $product->id)
                           ->latest('id')
                           ->take(4)
                           ->get(); 

        return view('livewire.details-component', compact('dollar', 'product', 'similares', 'sale'))->layout('layouts.base');
    }


    public function store()
    {
        $sale = Sale::find(1);
        
        $product_cart = CharacteristicProduct::find($this->id_product);
        
        $this->name = $product_cart->product->name.' '.$product_cart->product->brand->name.' '.$product_cart->characteristic->name;

        if ($product_cart->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon::now()) {

            Cart::instance('cart')->add($product_cart->id, $this->name, $this->qty, $product_cart->sale_price)->associate('App\Models\CharacteristicProduct');

        } else {
            
            Cart::instance('cart')->add($product_cart->id, $this->name, $this->qty, $product_cart->price)->associate('App\Models\CharacteristicProduct');

        }

        $this->reset('id_product');
    }



    public function increaseQuantityD()
    {
        $this->qty++;
    }

    public function decreaseQuantityD()
    {
        if ($this->qty > 1) 
        {
            $this->qty--;
        }
    }

    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
    }


}
