<?php

namespace App\Http\Livewire;

use App\Models\Slider;
use Livewire\Component;

class AboutComponent extends Component
{
    public function render()
    { 
        $sliders = Slider::all(); 

        return view('livewire.about-component', compact('sliders'))->layout('layouts.base');
    }
}
