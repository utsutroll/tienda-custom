<?php

namespace App\Http\Livewire;

use App\Models\DollarRate;
use Livewire\Component;
use App\Models\Product;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistComponent extends Component
{

    protected $listener = ['addCart' => 'render'];

    public function render()
    {
        if(Auth::check()){
            Cart::instance('wishlist')->erase(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }
        
        $dollar = DollarRate::all();
        $wishlists = Cart::instance('wishlist')->content();

        
        return view('livewire.wishlist-component', compact('dollar', 'wishlists'))->layout('layouts.base');
    }


    public function removeFromWishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if ($witem->rowId == $product_id) 
            {
                Cart::instance('wishlist')->remove($witem->rowId);

                $this->emit('wishlistRemoved');
                
                return;
            }
        }
    }
}
