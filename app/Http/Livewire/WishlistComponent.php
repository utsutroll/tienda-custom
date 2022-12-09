<?php

namespace App\Http\Livewire;

use App\Models\DollarRate;
use Livewire\Component;
use App\Models\Product;
use Cart;

class WishlistComponent extends Component
{

    protected $listener = ['addCart' => 'render'];

    public function render()
    {
        $dollar = DollarRate::all();

        
        return view('livewire.wishlist-component', compact('dollar'))->layout('layouts.base');
    }


    public function removeFromWishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if ($witem->rowId == $product_id) 
            {
                Cart::instance('wishlist')->remove($witem->rowId);
                return;
            }
        }
    }
}
