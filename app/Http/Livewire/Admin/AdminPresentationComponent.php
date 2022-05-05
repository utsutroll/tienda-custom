<?php

namespace App\Http\Livewire\Admin;

use App\Models\Presentation;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class AdminPresentationComponent extends Component
{
    /* Variables */
    public $search = '';
    public $entries = '5';
    public $sort = 'id';
    public $direcction = 'desc';
    public $name;
    public $medida;
    public $slug='';
    public $presentation_id;
    public $view = 'addPresentation';
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
        $presentations = Presentation::where('name', 'LIKE', "%{$this->search}%")
                                ->orWhere('medida', 'LIKE', "%{$this->search}%")
                                ->orderBy($this->sort, $this->direcction)
                                ->paginate($this->entries);

        return view('livewire.admin.admin-presentation-component', compact('presentations'))->layout('layouts.base-a');
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
        $this->reset(['medida']);
        $this->slug = '';
    }

    protected $rules = [
        'name' => 'required|min:1|numeric',   
        'medida' => 'required'    
    ];

    protected $validationAttributes = [
        'name' => 'Presentación',
        'medida' => 'Medida'
    ];

    public function save(){
        
        $this->validate();

        $this->slug = Str::slug($this->name.'-'.$this->medida);
        $presentation = Presentation::where('slug', $this->slug);
        

        if ($presentation->count() > 0) 
        {
            $this->emit('slugValidate');
            $this->slug = '';
        }
        else 
        {
            Presentation::create([
                'name' => $this->name,
                'medida' => $this->medida,
                'slug' => Str::slug($this->name.'-'.$this->medida)
            ]);

            $this->reset(['name']);
            $this->reset(['medida']);

            $this->emit('render');

            $this->emit('presentationAdded');
        }
    }
    /* End Create  */

    /* Edit/Update */

    public function edit($id)
    {
        $presentation = Presentation::find($id);

        $this->presentation_id = $id;
        $this->name = $presentation->name;
        $this->medida = $presentation->medida;
        $this->slug = '';
  
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:1|numeric',  
            'medida' => "required" 
        ]);

        $presentation = Presentation::find($this->presentation_id);

        $this->slug = Str::slug($this->name.'-'.$this->medida);
        
        if($presentation->slug == $this->slug) 
        {
            $this->emit('slugValidate');
            $this->slug = '';
        }
        else 
        {
            

            $presentation->update([
                'name' => $this->name,
                'medida' => $this->medida,
                'slug' => Str::slug($this->name.'-'.$this->medida)
            ]);
            
            $this->reset(['name']);
            $this->reset(['medida']);
            $this->emit('presentationEdited');
        }
    }
    /* End Edit/Update */

    /* Destroy */

    public function destroy($id)
    {
        $presentation = Presentation::findOrFail($id);

        try {
            $presentation->delete();
            $this->emit('presentationDeleted');
            
        } catch (\Exception $e) {

            $this->emit('presentationDeleted_e');
        }
    }
    /* End Destroy */
}
