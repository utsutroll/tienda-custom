<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class AdminCategoryComponent extends Component
{
    /* Variables */

    public $search = '';
    public $entries = '5';
    public $sort = 'id';
    public $direcction = 'desc';
    public $name;
    public $category_id;
    public $view = 'addCategory';
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
        $categories = Category::where('name', 'LIKE', "%{$this->search}%")
                                ->orderBy($this->sort, $this->direcction)
                                ->paginate($this->entries);

        return view('livewire.admin.admin-category-component', compact('categories'))->layout('layouts.base-a');
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
        'name' => 'required|max:30|unique:categories',   
    ];

    protected $validationAttributes = [
        'name' => 'Categoría'
    ];

    public function save(){
        
        $this->validate();

        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name)
        ]);

        $this->reset(['name']);

        $this->emit('render');

        $this->emit('categoryAdded');
    }
    /* End Create  */

    /* Edit/Update */

    public function edit($id)
    {
        $category = Category::find($id);

        $this->category_id = $id;
        $this->name = $category->name;
  
    }

    public function update()
    {
        $this->validate([
            'name' => "required|max:30|unique:categories,name,$this->category_id",  
        ]);

        $category = Category::find($this->category_id);

        $category->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name)
        ]);
        
        $this->reset(['name']);
        $this->emit('categoryEdited');
        
    }
    /* End Edit/Update */

    /* Destroy */

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        try {
            $category->delete();
            $this->emit('categoryDeleted');
            
        } catch (\Exception $e) {

            $this->emit('categoryDeleted_e');
        }

    }
    /* End Destroy */
}
