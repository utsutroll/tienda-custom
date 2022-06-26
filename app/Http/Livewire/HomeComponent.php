<?php

namespace App\Http\Livewire;

use App\Models\BusinessPartner;
use App\Models\DollarRate;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Subcategory;
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
    

    public function render()
    {
        $dollar = DollarRate::all();
        $sliders = Slider::all();
        $business_partners = BusinessPartner::all();

        
        $products = DB::table('products')
                        ->join('brands', 'brands.id', '=', 'products.brand_id')
                        ->join('images', 'images.imageable_id', '=', 'products.id')
                        ->select(
                            'products.name as product', 
                            'brands.name as brand',
                            'images.url as imagen',
                            'products.price as price',
                            'products.slug as slug',
                            'products.stock as stock')
                            ->where('stock', '>', '0')
                        ->take(8)->get();

        $newproducts = DB::table('products')
                            ->join('brands', 'brands.id', '=', 'products.brand_id')
                            ->join('images', 'images.imageable_id', '=', 'products.id')
                            ->where('stock', '>', '0')
                            ->select(
                                'products.name as product', 
                                'brands.name as brand',
                                'images.url as imagen',
                                'products.price as price',
                                'products.slug as slug',
                                'products.stock as stock')
                            ->orderBy('products.created_at', 'desc') 
                            ->take(8)->get();
        

        return view('livewire.home-component', compact('dollar', 'products', 'newproducts', 'sliders', 'business_partners'))->layout('layouts.base');
    }

}
