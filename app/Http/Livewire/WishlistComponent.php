<?php

namespace App\Http\Livewire;

use App\Models\DollarRate;
use App\Models\Product;
use Livewire\Component;
use Cart;

class WishlistComponent extends Component
{

    protected $listener = ['addCart' => 'render'];

    public function render()
    {
        $dollar = DollarRate::all();

        $this->setAmountForCheckout();
        
        return view('livewire.wishlist-component', compact('dollar'))->layout('layouts.base');
    }

    public function store($product_id, $product_name, $product_price)
    {   
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');

        $this->emit('addCart');
    }

    public function removeFromWishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if ($witem->id == $product_id) 
            {
                Cart::instance('wishlist')->remove($witem->rowId);
                return;
            }
        }
    }

    public function moveProductFromWishlistToCart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);
        $pro = Product::find($item->id);
        if ($pro->stock == 0)
        {
            $this->emit('addCartError');
        }else 
        {
            Cart::instance('wishlist')->remove($rowId);
            Cart::instance('cart')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');    
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
            
            return redirect()->route('products-checkout');

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
