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

    protected $paginationTheme = "tailwind";

    public function updatingSearch(){
        $this->resetPage();
    }

    protected $queryString = [
        'search' => ['except' => ''],
        'entries' => ['except' => '30']
    ];


    public function mount($category_slug)
    {
        $this->category_slug = $category_slug;
    }

    public function render()
    {
        $dollar = DollarRate::all();
        $sliders = Slider::all();
        $business_partners = BusinessPartner::all();
        $categories = Category::all();
        $categori = Category::where('slug',$this->category_slug)->first();
        $category_id = $categori->id;
        $this->category_name = $categori->name;


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
        }
            

        return view('livewire.category-component', compact('productss', 'dollar', 'categories', 'sliders', 'business_partners'))->layout('layouts.base');
    }

}
