<?php

namespace App\Http\Livewire\Admin;

use App\Models\CharacteristicProduct;
use Livewire\Component;

class AdminStockComponent extends Component
{
    /* Variables */
    public $status_p;
    /* End Variables */


    protected $listeners = ['render', 'render'];

    public function render()
    {
        $products = CharacteristicProduct::all();

        return view('livewire.admin.admin-stock-component', compact('products'));
    }
}
