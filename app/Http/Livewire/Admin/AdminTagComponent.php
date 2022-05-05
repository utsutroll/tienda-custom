<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class AdminTagComponent extends Component
{
    /* Variables */

    public $search = '';
    public $entries = '5';
    public $sort = 'id';
    public $direcction = 'desc';
    public $name;
    public $tag_id;
    public $view = 'addTag';
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
        $tags = Tag::where('name', 'LIKE', "%{$this->search}%")
                                ->orderBy($this->sort, $this->direcction)
                                ->paginate($this->entries);

        return view('livewire.admin.admin-tag-component', compact('tags'))->layout('layouts.base-a');
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
    }

    protected $rules = [
        'name' => 'required|max:15|unique:tags',   
    ];

    protected $validationAttributes = [
        'name' => 'Etiqueta'
    ];

    public function save(){
        
        $this->validate();

        Tag::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name)
        ]);

        $this->reset(['name']);

        $this->emit('render');

        $this->emit('tagAdded');
    }
    /* End Create  */

    /* Edit/Update */

    public function edit($id)
    {
        $tag = Tag::find($id);

        $this->tag_id = $id;
        $this->name = $tag->name;
  
    }

    public function update()
    {
        $this->validate([
            'name' => "required|unique:tags,name,$this->tag_id",  
        ]);

        $tag = Tag::find($this->tag_id);

        $tag->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name)
        ]);
        
        $this->reset(['name']);
        $this->emit('tagEdited');
        
    }
    /* End Edit/Update */

    /* Destroy */

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);

        try {
            $tag->delete();
            $this->emit('tagDeleted');
            
        } catch (\Exception $e) {

            $this->emit('tagDeleted_e');
        }

    }
    /* End Destroy */
}
