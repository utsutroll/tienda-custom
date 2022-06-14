<?php

namespace App\Http\Livewire\Admin;

use App\Models\CharacteristicProductEntry;
use Livewire\Component;

class AdminProductEntryComponent extends Component
{
    /* Variables */
    public $status_p;
    /* End Variables */

    /* Table */

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $products = CharacteristicProductEntry::all();

        return view('livewire.admin.admin-product-entry-component', compact('products'));
    }

}
