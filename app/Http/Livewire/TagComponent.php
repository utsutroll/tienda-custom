<?php

namespace App\Http\Livewire;

use App\Models\BusinessPartner;
use App\Models\Category;
use App\Models\DollarRate;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Slider;
use App\Models\Tag;
use Cart;
use Livewire\Component;
use Livewire\WithPagination;

class TagComponent extends Component
{
    use WithPagination;

    public $search ='';
    public $tag_slug;
    public $tag_name;

    protected $paginationTheme = "tailwind";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function mount($tag_slug)
    {
        $this->tag_slug = $tag_slug;
    }

    protected $listener = ['addCart' => 'render', 'addWishlist' => 'render'];

    public function render()
    {
        $dollar = DollarRate::all();
        $sliders = Slider::all();
        $business_partners = BusinessPartner::all();
        $categories = Category::all();
        $tag = Tag::all();
        $tags= Tag::where('slug',$this->tag_slug)->first();
        $this->tag_name = $tags->name;

        $this->setAmountForCheckout();
        
        $productss = $tags->products()->where('name', 'LIKE', "%{$this->search}%")
                            ->where('sale_price', '0')
                            ->paginate(15);
  
        return view('livewire.tag-component', compact('productss', 'dollar', 'categories', 'tag', 'sliders', 'business_partners'))->layout('layouts.base');
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
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
