<?php

namespace App\Http\Livewire;

use App\Models\BusinessPartner;
use App\Models\Category;
use App\Models\DollarRate;
use App\Models\Product;
use App\Models\Slider;
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
            return Product::where('name', 'LIKE', "%{$this->search}%")
                            ->paginate($this->entries);
        } 
        $this->filter['subcategory'] = array_filter($this->filter['subcategory']);
        return Product::whereIn('subcategory_id', array_keys($this->filter['subcategory']))->paginate($this->entries);
        
    }


    public function render()
    {
        $dollar = DollarRate::all();
        $sliders = Slider::all();
        $business_partners = BusinessPartner::all();
        /*$categories = Category::all();
        
        $products = Product::where('name', 'LIKE', "%{$this->search}%")
                                ->paginate($this->entries);
         if ($this->buscar == 1 ) {
            $productss = Product::where('name', 'LIKE', "%{$this->search}%")
                                ->where('sale_price', '0')
                                ->where('category_id', $category_id)
                                ->paginate($this->entries);
                    if ($productss == []) {
                    }
        } else {
            $productss = Product::where('category_id', $category_id)
                                ->where('sale_price', '0')
                                ->paginate($this->entries);
        } */
            

        return view('livewire.category-component', compact('dollar', 'sliders', 'business_partners'))->layout('layouts.base');
    }

    public function refresh() {
        $this->reset(['filter']);
    }

}
