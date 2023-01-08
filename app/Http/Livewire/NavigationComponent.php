<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavigationComponent extends Component
{
    
    protected $listeners = [
        'whishlistAdded' => 'render',
        'wishlistRemoved'  => 'render',
        'cartAdded' => 'render', 
        'cartRemoved' => 'render'
    ];

    public function render()
    {
        return view('livewire.navigation-component');
    }

}
