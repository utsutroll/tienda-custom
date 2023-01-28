<?php

namespace App\Http\Livewire;

use App\Models\BusinessPartner;
use App\Models\DollarRate;
use App\Models\Product;
use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use Illuminate\Support\Facades\Auth;


class ShopComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $entries = '30';
    public $subcategory;
    public $buscar;

    protected $paginationTheme = "tailwind";

    public function updatingSearch(){
        $this->resetPage();
    }

    protected $queryString = [
        'search' => ['except' => ''],
        'entries' => ['except' => '30']
    ];

    protected $listeners = ['render' => 'render'];
    
    public function render()
    {
        if(Auth::check()){
            Cart::instance('wishlist')->erase(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        $dollar = DollarRate::all();
        $sliders = Slider::all();
        $business_partners = BusinessPartner::all();

        $products = Product::where('name', 'LIKE', "%{$this->search}%")                
                            ->where('stock', '>', '0')
                            ->where('price', '>', '0')
                            ->paginate($this->entries);


        return view('livewire.shop-component', compact('dollar', 'products', 'sliders'))->layout('layouts.base');
    }

    public function addToWishlist($id, $name, $price)
    {   
        Cart::instance('wishlist')->add($id,$name,1,$price)->associate('App\Models\Product');

        $this->emit('whishlistAdded');

        $this->emit('alert', 'El producto se agregó a la lista de deseos con éxito.');
    }

    public function removeFromWishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if ($witem->id == $product_id) 
            {
                $user = Auth::user()->email;

                Cart::instance('wishlist')->remove($witem->rowId);
                Cart::erase($user);

                $this->emit('wishlistRemoved');
                $this->emit('render');

                $this->emit('alert', 'El producto se eliminó a la lista de deseos con éxito.');
                return;
            }
        }
    }
}
