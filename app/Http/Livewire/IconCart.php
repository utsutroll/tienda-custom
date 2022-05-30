<?php

namespace App\Http\Livewire;

use Livewire\Component;

class IconCart extends Component
{
    protected $listener = ['refreshIconCart' => 'render'];

    public function render()
    {
        return view('livewire.icon-cart');
    }
}
