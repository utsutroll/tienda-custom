<?php

namespace App\Http\Livewire;

use App\Models\BusinessPartner;
use App\Models\Category;
use App\Models\DollarRate;
use App\Models\Slider;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class CategoryComponent extends Component
{
    use WithPagination;

    public $category_slug;
    public $category_name;
    public $search= '';
    public $entries = 30;
    public $buscar;
    public $subcategories;
    public $products;
    public $category;
    public $subcategory;

    public $filter = [
        'subcategory' => [],
    ];

    protected $paginationTheme = "tailwind";

    public function updatingSearch(){
        $this->resetPage();
    } 

    protected $queryString = [
        'search' => ['except' => ''],
        'entries' => ['except' => '30']
    ];

    public function getCategoriesProperty() {

        return Category::all();
    }

    public function subcategories($id) {

        $this->subcategories = DB::table('subcategories')->where('category_id', $id)->get();
        
        $categoria = Category::find($id);

        $this->category = $categoria->name;

    }
    
    public function products($id) {
        
        $this->products = DB::table('products')
                                ->join('brands', 'brands.id', '=', 'products.brand_id')
                                ->join('images', 'images.imageable_id', '=', 'products.id')
                                ->where('stock', '>', '0')
                                ->where('subcategory_id', '=', $id)
                                ->select(
                                    'products.id as id',
                                    'products.name as product', 
                                    'brands.name as brand',
                                    'images.url as imagen',
                                    'products.price as price',
                                    'products.slug as slug',
                                    'products.stock as stock')
                                ->orderBy('products.created_at', 'desc') 
                                ->get();
                                
        $this->reset('subcategories');
        $this->reset('category');
        

        $subcategoria = Subcategory::find($id);

        $this->subcategory = $subcategoria->name;
    }

    


    public function render()
    {
        $dollar = DollarRate::all();
        $sliders = Slider::all();
        $business_partners = BusinessPartner::all();

        return view('livewire.category-component', compact('dollar', 'sliders', 'business_partners'))->layout('layouts.base');
    }

    public function refresh() {
        $this->reset(['products']);
        $this->reset(['subcategories']);
        $this->reset(['subcategory']);
        $this->reset(['category']);
    }

    public function addToWishlist($id, $name, $price)
    {   
        Cart::instance('wishlist')->add($id,$name,1,$price)->associate('App\Models\Product');
        Cart::instance('wishlist')->store(Auth::user()->id);

        $this->emit('whishlistAdded');
        $this->emit('render');

        $this->emit('alert', 'El producto se agregó a la lista de deseos con éxito.');
    }

    public function removeFromWishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if ($witem->id == $product_id) 
            {
                Cart::instance('wishlist')->remove($witem->rowId)->erase(Auth::user()->id);

                $this->emit('alert', 'El producto se eliminó a la lista de deseos con éxito.');
                return;
            }
        }
    }

}
