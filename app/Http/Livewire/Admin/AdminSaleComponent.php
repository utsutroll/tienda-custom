<?php

namespace App\Http\Livewire\Admin;

use App\Models\CharacteristicProduct;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;
class AdminSaleComponent extends Component
{
    /* Variables */
    public $status;
    public $sale_date;
    public $product_id;
    public $sproduct_id;
    /* End Variables */

    /* Table */

    
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

        $sproducts = CharacteristicProduct::all()->where('sale_price', '>', 0);

        return view('livewire.admin.admin-sale-component', compact('sproducts'))->layout('layouts.base-a');
    } 

}
