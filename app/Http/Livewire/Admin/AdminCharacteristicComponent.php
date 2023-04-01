<?php

namespace App\Http\Livewire\Admin;

use App\Models\Characteristic;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class AdminCharacteristicComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    
    /* Variables */
    public $name;
    public $slug='';
    public $characteristic_id;
    public $view = 'addCharacteristic';

    public $search;
    public $entries = 5;
    public $sortBy = 'id';
    public $sortAsc = 'true';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => false],
    ];
    /* End Variables */

    protected $listeners = ['render', 'render'];

    public function render()
    {

        $characteristics = DB::table('characteristics')
                        ->select('id', 'name')
                        ->when($this->search, function($query) {
                            return $query->where(function ($query) {
                                $query->where('name', 'like', '%' .$this->search. '%');
                            });
                        })
                        ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');


        $characteristics = $characteristics->paginate($this->entries);

        return view('livewire.admin.admin-characteristic-component', compact('characteristics'))->layout('layouts.base-a');
    }

    public function updatingSearch() 
    {
        $this->resetPage();
    }

    public function sortBy($field) 
    {
        if($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
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
