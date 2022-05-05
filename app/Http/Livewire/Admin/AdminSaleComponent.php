<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSaleComponent extends Component
{
    /* Variables */
    public $status;
    public $sale_date;
    public $views = 'table';
    public $search = '';
    public $entries = '5';
    public $sort = 'id';
    public $direcction = 'desc';
    public $category;
    public $ssearch ='';
    public $sprice;
    public $sproduct_id;
    /* End Variables */

    /* Table */

    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
            $this->resetPage();
    }

    protected $queryString = [
        'search' => ['except' => ''],
        'entries' => ['except' => '5']
    ];
    
    public function mount()
    {
        $sale = Sale::find(1);

        if($sale == null)
        {
            $this->sale_date = Carbon::now()->format('d/m/Y h:m:s');
            $this->status = 0;
        }
        else 
        {
            $this->sale_date = $sale->sale_date;
            $this->status = $sale->status;
        }
        
    }
    
    public function render()
    {
        $categories = Category::all();

        $ssproducts = Product::where('name', 'LIKE', "%{$this->ssearch}%")
                                ->where('category_id', $this->category)
                                ->paginate(10);

        $sproducts = Product::where('sale_price', '>', 0)
                            ->where('name', 'LIKE', "%{$this->search}%")
                            ->orderBy($this->sort, $this->direcction)
                            ->paginate($this->entries);

        return view('livewire.admin.admin-sale-component', compact('sproducts', 'categories', 'ssproducts'))->layout('layouts.base-a');
    }

    public function order($sort){

        if ($this->sort == $sort) {
            
            if ($this->direcction == 'desc') {
                $this->direcction = 'asc';
            }else{
                $this->direcction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direcction = 'asc';
        }
        
    }
    public function clear(){

        $this->search = '';
        $this->page = 1;
        $this->entries = '5';

    }
    /* End Table */

    public function update($sid)
    {
        $this->sproduct_id = $sid;
        $this->validate([
            'sprice' => "required|min:0|numeric",  
        ]);

        $sproduct = Product::find($this->sproduct_id);  

        $sproduct->update([
            'sale_price' => $this->sprice,
        ]);

        $this->reset(['sprice']);

    }    

    public function updateSale()
    {

        $sale = Sale::find(1);
        if ($sale == null) 
        {
            Sale::create([
                'sale_date' => Carbon::parse($this->sale_date)->format('Y/m/d h:m:s'),
                'status' => $this->status,
            ]);

            $this->emit('addSales');
            $this->views = 'table';
        }
        else 
        {
            $sale->sale_date = Carbon::parse($this->sale_date)->format('Y/m/d h:m:s');
            $sale->status = $this->status;
            $sale->save();

            $this->emit('updateSales');
            $this->views = 'table';
        }
        
    }

    public function restorePriceOffer()
    {
        $products = Product::all();

        foreach($products as $product)
        {
            $product->update([
                'sale_price' => '0',
            ]);
        }
        
        $this->emit('updateSalesOffer');
        $this->views = 'table';
    }

}
