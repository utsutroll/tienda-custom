<?php

namespace App\Http\Livewire;


use App\Models\CharacteristicProduct;
use App\Models\Sale;
use Livewire\Component;

class Offer extends Component
{
    public function render()
    {   
        $sproducts = CharacteristicProduct::all()->where('sale_price', '>', 0)->take(8);
        
        if($sproducts->count() < 0)
        {
            $this->sproducts = null;
        }

        $sale = Sale::find(1);

        return view('livewire.offer', compact('sproducts', 'sale'));
    }
}
