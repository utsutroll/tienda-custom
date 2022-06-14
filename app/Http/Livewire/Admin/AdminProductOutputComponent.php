<?php

namespace App\Http\Livewire\Admin;

use App\Models\CharacteristicProductOutput;
use Livewire\Component;

class AdminProductOutputComponent extends Component
{
    /* Variables */
    public $status_p;

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $products = CharacteristicProductOutput::all();
                            
        return view('livewire.admin.admin-product-output-component', compact('products'));
    }

}
