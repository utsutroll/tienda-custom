<?php

namespace App\Http\Livewire;

use App\Models\BusinessPartner;
use App\Models\DollarRate;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use Illuminate\Support\Facades\Auth;

class ShopComponent extends Component
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

        $products = Product::where('name', 'LIKE', "%{$this->search}%")                
                            ->where('stock', '>', '0')
                            ->paginate($this->entries);


        return view('livewire.shop-component', compact('dollar', 'products', 'sliders'))->layout('layouts.base');
    }
}
