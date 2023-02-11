<?php

namespace App\Http\Livewire\Admin;

use App\Models\Characteristic;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminCharacteristicComponent extends Component
{
    /* Variables */
    public $name;
    public $slug='';
    public $characteristic_id;
    public $view = 'addCharacteristic';
    /* End Variables */

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $characteristics = Characteristic::all();

        return view('livewire.admin.admin-characteristic-component', compact('characteristics'))->layout('layouts.base-a');
    }

    /* Create */
    public function create()
    {
        $this->reset(['name']);
        $this->slug = '';
    }

    protected $rules = [
        'name' => 'required|min:1|unique:characteristics'    
    ];

    protected $validationAttributes = [
        'name' => 'Característica'
    ];

    public function save(){
        
        $this->validate();

        $this->emit('render');
        
        Characteristic::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name)
        ]);

        $this->reset(['name']);
        $this->emit('render');
        $this->emit('characteristicAdded');
        
    }
    /* End Create  */

    /* Edit/Update */

    public function edit($id)
    {
        $characteristic = Characteristic::find($id);

        $this->characteristic_id = $id;
        $this->name = $characteristic->name;
        $this->slug = '';
  
    }

    public function update()
    {
        $this->validate([
            'name' => "required|min:1|unique:characteristics,name,$this->characteristic_id"
        ]);

        $this->emit('render');

        $characteristic = Characteristic::find($this->characteristic_id);

        $characteristic->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name)
        ]);
            
        $this->reset(['name']);
        $this->emit('characteristicEdited');
        
    }
    /* End Edit/Update */

    /* Destroy */

    public function destroy($id)
    {
        $characteristic = Characteristic::findOrFail($id);

        try {
            $characteristic->delete();
            $this->emit('characteristicDeleted');
            $this->emit('render');
            
        } catch (\Exception $e) {

            $this->emit('characteristicDeleted_e');
            $this->emit('render');
        }
    }
    /* End Destroy */
}
