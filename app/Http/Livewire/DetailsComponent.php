<?php

namespace App\Http\Livewire;

use App\Models\DollarRate;
use App\Models\Product;
use App\Models\Sale;
use Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DetailsComponent extends Component
{
    public $slug;
    public $qty = 1;
    

    protected $listener = ['addCart' => 'render', 'addWishlist' => 'render'];

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $dollar = DollarRate::all();
        $sale = Sale::find(1);

        $product = Product::where('slug', $this->slug)->first();

        $similares = Product::where('category_id', $product->category_id)
                           ->where('id', '!=', $product->id)
                           ->where('sale_price', '0')
                           ->latest('id')
                           ->take(4)
                           ->get(); 

        $this->setAmountForCheckout();

        return view('livewire.details-component', compact('dollar', 'product', 'similares', 'sale'))->layout('layouts.base');
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,$this->qty,$product_price)->associate('App\Models\Product');
        $this->emit('addCart');
    }

    public function addToWishlist($product_id, $product_name, $product_price)
    {   
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');

        $this->emit('addWishlist');
    }

    public function removeFromWishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if ($witem->id == $product_id) 
            {
                Cart::instance('wishlist')->remove($witem->id);
                return;
            }
        }
    }

    public function increaseQuantityD()
    {
        $this->qty++;
    }

    public function decreaseQuantityD()
    {
        if ($qty > 1) 
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

    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
    }

    public function destroyAll()
    {
        Cart::instance('cart')->destroy();
    }

    public function checkout()
    {
        if (Auth::check()) {
            
            return redirect()->route('checkout');

        } else {
            
            return redirect()->route('login');
        }  
    }

    public function setAmountForCheckout()
    {
        if(!Cart::instance('cart')->count() > 0)
        {
            session()->forget('checkout');
            return;
        }
        
        session()->put('checkout',[
            'discount' => 0,
            'subtotal' => Cart::instance('cart')->subtotal(),
            'tax' => Cart::instance('cart')->tax(),
            'total' => Cart::instance('cart')->total(),
        ]);
    }
}
