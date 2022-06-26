<?php

namespace App\Http\Livewire;

use App\Models\BusinessPartner;
use App\Models\Category;
use App\Models\DollarRate;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;

    public $category_slug;
    public $category_name;
    public $search= '';
    public $entries = 30;
    public $buscar;

    public $filter = [
        'subcategory' => []
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

    public function getResultsProperty() {

        if (empty($this->filter['subcategory'])) {
            return DB::table('products')
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
                            ->paginate($this->entries);
        } 

        $this->filter['subcategory'] = array_filter($this->filter['subcategory']);
        return DB::table('products')
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
                    ->whereIn('subcategory_id', array_keys($this->filter['subcategory']))
                    ->paginate($this->entries);
        
    }


    public function render()
    {
        $dollar = DollarRate::all();
        $sliders = Slider::all();
        $business_partners = BusinessPartner::all();

        return view('livewire.category-component', compact('dollar', 'sliders', 'business_partners'))->layout('layouts.base');
    }

    public function refresh() {
        $this->reset(['filter']);
    }

}
