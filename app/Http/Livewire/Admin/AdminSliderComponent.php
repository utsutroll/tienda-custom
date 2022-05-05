<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSliderComponent extends Component
{
    /* Variables */

    public $search = '';
    public $entries = '5';
    public $sort = 'id';
    public $direcction = 'desc';
    public $name;
    public $tag_id;
    public $view = 'create';
    /* End Variables */
    
    /* Table */

    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
            $this->resetPage();
    }

    protected $queryString = [
        'search' => ['except' => ''],
        'entries' => ['except' => '5']
    ];


    protected $listeners = ['render', 'render'];

    public function render()
    {
        $sliders = Slider::where('title', 'LIKE', "%{$this->search}%")
                        ->orderBy($this->sort, $this->direcction)
                        ->paginate($this->entries);

        return view('livewire.admin.admin-slider-component', compact('sliders'));
    }

    public function order($sort){

        if ($this->sort == $sort) {
            
            if ($this->direcction == 'desc') {
                $this->direcction = 'asc';
            }else{
                $this->direcction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direcction = 'asc';
        }
        
    }
    public function clear(){

        $this->search = '';
        $this->page = 1;
        $this->entries = '5';

    }
    /* End Table */

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
