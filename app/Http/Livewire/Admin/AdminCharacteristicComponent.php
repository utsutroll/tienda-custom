<?php

namespace App\Http\Livewire\Admin;

use App\Models\Characteristic;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class AdminCharacteristicComponent extends Component
{
    /* Variables */
    public $search = '';
    public $entries = '5';
    public $sort = 'id';
    public $direcction = 'desc';
    public $name;
    public $slug='';
    public $characteristic_id;
    public $view = 'addCharacteristic';
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
        $characteristics = Characteristic::where('name', 'LIKE', "%{$this->search}%")
                                            ->orderBy($this->sort, $this->direcction)
                                            ->paginate($this->entries);

        return view('livewire.admin.admin-characteristic-component', compact('characteristics'))->layout('layouts.base-a');
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
            
        } catch (\Exception $e) {

            $this->emit('characteristicDeleted_e');
        }
    }
    /* End Destroy */
}
