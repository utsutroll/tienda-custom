<?php

namespace App\Http\Livewire\Admin;

use App\Models\CharacteristicProduct;
use App\Models\Sale;
use App\Models\Subcategory;
use Carbon\Carbon;
use Livewire\Component;
class AdminSaleComponent extends Component
{
    /* Variables */
    public $status;
    public $sale_date;
    public $views = 'table';
    public $producto;
    public $nombre = '';
    public $precio;
    public $price;
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
        $ssproducts = CharacteristicProduct::all();

        $sproducts = CharacteristicProduct::all()->where('sale_price', '>', 0);

        return view('livewire.admin.admin-sale-component', compact('sproducts', 'ssproducts'))->layout('layouts.base-a');
    }

    public function buscar()
    {
        $p = CharacteristicProduct::find($this->producto);
        $this->nombre = $p->product->name.' '.$p->product->brand->name.' '.$p->characteristic->name;
        $this->precio = $p->sale_price;
        $this->product_id = $p->id;

    }

    public function update($id)
    {
        $product = CharacteristicProduct::find($id);

        $this->validate([
            'price' => "required",  
        ]);

        CharacteristicProduct::where('id', $product->id)->update(['sale_price' => $this->price]);

        $this->reset(['price']);
        $this->reset(['nombre']);
        $this->reset(['precio']);
        $this->reset(['product_id']);


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
        $products = CharacteristicProduct::all();

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
