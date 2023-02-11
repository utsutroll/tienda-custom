<?php

namespace App\Http\Livewire;

use App\Models\BusinessPartner;
use App\Models\DollarRate;
use App\Models\Product;
use App\Models\Slider;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class HomeComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $entries = '8';
    public $subcategory;
    public $buscar;

    protected $paginationTheme = "tailwind";

    public function updatingSearch(){
        $this->resetPage();
    }

    protected $queryString = [
        'search' => ['except' => ''],
        'entries' => ['except' => '8']
    ];

    protected $listener = ['render' => 'render'];

    public function render()
    {
        $dollar = DollarRate::all();
        $sliders = Slider::all();
        $business_partners = BusinessPartner::all();  

        
        $products = DB::table('products')
                        ->join('brands', 'brands.id', '=', 'products.brand_id')
                        ->join('images', 'images.imageable_id', '=', 'products.id')
                        ->select(
                            'products.id as id',
                            'products.name as product', 
                            'brands.name as brand',
                            'images.url as imagen',
                            'products.price as price',
                            'products.slug as slug',
                            'products.stock as stock')
                            ->where('products.price', '>', '0')
                        ->take(8)->get();

        $newproducts = DB::table('products')
                            ->join('brands', 'brands.id', '=', 'products.brand_id')
                            ->join('images', 'images.imageable_id', '=', 'products.id')
                            ->where('products.price', '>', '0')
                            ->select(
                                'products.id as id',
                                'products.name as product', 
                                'brands.name as brand',
                                'images.url as imagen',
                                'products.price as price',
                                'products.slug as slug',
                                'products.stock as stock')
                            ->orderBy('products.created_at', 'desc') 
                            ->take(8)->get();
        
        if (Auth::check()) {
            Cart::instance('wishlist')->restore(Auth::user()->email);
        }                         
        return view('livewire.home-component', compact('dollar', 'products', 'newproducts', 'sliders', 'business_partners'))->layout('layouts.base');
    }

    public function addToWishlist($id, $name, $price, $url, $brand, $slug)
    {   

        $cartItem = Cart::instance('wishlist')->add(['id' => $id, 'name' => $name, 'qty' => 1, 'price' => $price, 'weight' => 550, 'options' => ['url' => $url, 'brand' => $brand, 'slug' => $slug]]);
        Cart::associate($cartItem->rowId, Product::class);
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

                $this->emit('alert', 'El producto se eliminó de la lista de deseos con éxito.');

                return;
            }
        }
    }

}
