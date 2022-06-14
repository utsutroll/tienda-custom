<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;

class AdminSliderComponent extends Component
{
    /* Variables */
    public $name;
    public $tag_id;
    public $view = 'create';
    /* End Variables */

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $sliders = Slider::all();

        return view('livewire.admin.admin-slider-component', compact('sliders'));
    }

    /* Destroy */

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        try {
            $slider->delete();
            $this->emit('sliderDeleted');
            
        } catch (\Exception $e) {

            $this->emit('sliderDeleted_e');
        }

    }
    /* End Destroy */
}
