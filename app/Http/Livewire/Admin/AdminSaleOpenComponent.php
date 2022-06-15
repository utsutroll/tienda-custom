<?php

namespace App\Http\Livewire\Admin;

use App\Models\CharacteristicProduct;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;

class AdminSaleOpenComponent extends Component
{
    /* Variables */
    public $status;
    public $sale_date;
    public $product_id;
    public $sproduct_id;
    /* End Variables */

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

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        return view('livewire.admin.admin-sale-open-component')->layout('layouts.base-a');
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
            $this->emit('render');
        }
        else 
        {
            $sale->sale_date = Carbon::parse($this->sale_date)->format('Y/m/d h:m:s');
            $sale->status = $this->status;
            $sale->save();

            $this->emit('updateSales');
            $this->emit('render');
            
        }
        
    }

    public function restorePriceOffer()
    {
        $products = CharacteristicProduct::all();

        foreach($products as $product)
        {
            $product->update([
                'sale_price' => '0',
            ]);
        }
        
        $this->emit('updateSalesOffer');
        $this->emit('render');
    }
}
