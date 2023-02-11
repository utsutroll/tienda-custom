<?php

namespace App\Http\Livewire;

use App\Models\CharacteristicProduct;
use App\Models\DollarRate;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function getDollarProperty()
    {
        return DB::table('dollar_rates')->select('price')->get();
    }
    
    public function render()
    {
        if(Auth::check()){
            Cart::instance('wishlist')->erase(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        $sale = Sale::find(1);

        $product = Product::where('slug', $this->slug)->first();

        $similares = DB::table('products')
                        ->join('brands', 'brands.id', '=', 'products.brand_id')
                        ->join('images', 'images.imageable_id', '=', 'products.id')
                        ->select(
                            'products.id as id',
                            'products.name as product', 
                            'brands.name as brand',
                            'images.url as imagen',
                            'products.price as price',
                            'products.slug as slug',
                            'products.stock as stock',
                            'products.subcategory_id as subcategory_id')
                        ->where('subcategory_id', $product->subcategory_id)
                        ->where('products.id', '!=', $product->id)
                        ->latest('products.id')
                        ->take(4)
                        ->get(); 

        return view('livewire.details-component', compact('product', 'similares', 'sale'))->layout('layouts.base');
    }


    protected $rules = [
        'id_product' => 'required',   
    ];

    protected $validationAttributes = [
        'id_product' => 'Producto'
    ];

    public function store()
    {
        $this->validate();

        $sale = Sale::find(1);
         
        $product_cart = CharacteristicProduct::find($this->id_product);
        
        $this->name = $product_cart->product->name.' '.$product_cart->product->brand->name.' '.$product_cart->characteristic->name;

        if ($product_cart->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon::now()) {

            Cart::instance('cart')->add($product_cart->id, $this->name, $this->qty, $product_cart->sale_price)->associate('App\Models\CharacteristicProduct');
            
            $pro_id = Product::where('slug', $this->slug)->first();

            foreach(Cart::instance('wishlist')->content() as $witem)
            {
                if ($witem->id == $pro_id->id)  
                {
                    Cart::instance('wishlist')->remove($witem->rowId);
                }
            }
        } else {
            
            Cart::instance('cart')->add($product_cart->id, $this->name, $this->qty, $product_cart->price)->associate('App\Models\CharacteristicProduct');
            
            $pro_id = Product::where('slug', $this->slug)->first();

            foreach(Cart::instance('wishlist')->content() as $witem)
            {

                if ($witem->id == $pro_id->id) 
                {
                    Cart::instance('wishlist')->remove($witem->rowId);
                }
            }
        }

        $this->reset('id_product');

        $this->emit('cartAdded');

        $this->emit('alert', 'El producto se agregó al carrito de compras con éxito.');

        
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
