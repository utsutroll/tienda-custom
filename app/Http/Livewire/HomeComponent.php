<?php

namespace App\Http\Livewire;

use App\Models\BusinessPartner;
use App\Models\DollarRate;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Subcategory;
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
        $subcategories = Subcategory::all();
        $dollar = DollarRate::all();
        $sliders = Slider::all();
        $business_partners = BusinessPartner::all();

        
        $products = Product::take(8)->get();

        $newproducts = Product::orderBy('created_at', 'desc')
                                ->take(8)->get();
        

        return view('livewire.home-component', compact('subcategories', 'dollar', 'products', 'newproducts', 'sliders', 'business_partners'))->layout('layouts.base');
    }

}
