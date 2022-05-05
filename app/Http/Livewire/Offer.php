<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class Offer extends Component
{
    public function render()
    {   
        $sproducts = Product::where('sale_price', '>', 0)->inRandomOrder()->get()->take(8);
        
        if($sproducts->count() < 0)
        {
            $this->sproducts = null;
        }

        $sale = Sale::find(1);

        return view('livewire.offer', compact('sproducts', 'sale'));
    }
}
