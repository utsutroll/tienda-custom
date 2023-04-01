<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = "bootstrap";
    
    /* Variables */
    public $name;
    public $image;
    public $imagen;
    public $oldimage;
    public $category_id;
    public $view = 'addCategory';

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
        $categories = DB::table('categories')
                        ->select('id', 'name', 'url')
                        ->when($this->search, function($query) {
                            return $query->where(function ($query) {
                                $query->where('name', 'like', '%' .$this->search. '%');
                            });
                        })
                        ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');


        $categories = $categories->paginate($this->entries);

        return view('livewire.admin.admin-category-component', compact('categories'))->layout('layouts.base-a');
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

    /*End Table */

    /* Create */
    public function create()
    {
        $this->reset(['name']);
        $this->reset(['imagen']);
    }

    protected $rules = [
        'name' => 'required|regex:/^[\pL\s\-]+$/u|max:40|unique:categories', 
        'imagen' => 'required|image'  
    ];

    protected $validationAttributes = [
        'name' => 'Categoría',
        'image' => 'Imágen',
        'imagen' => 'Imágen',
    ];

    public function save(){
        
        $this->validate();

        $this->imagen->store('icons'); 
        $url = $this->imagen->store('icons'); 

        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'url' => $url
        ]);

        $this->reset(['name']);
        $this->reset(['imagen']);

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
        $this->image = $category->url;
        $this->oldimage = $category->url;
  
    }

    public function update()
    {
        $this->validate([
            'name' => "required|regex:/^[\pL\s\-]+$/u|max:40|unique:categories,name,$this->category_id", 
            'image' => 'required|image' 
        ]);

        $category = Category::find($this->category_id);

        if ($category->url == '') {

            $this->image->store('icons');
            $url = $this->image->store('icons');

        }else {
            
            Storage::disk('public')->delete($category->url);
            $this->image->store('icons');
            $url = $this->image->store('icons');
        }


        $category->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'url' => $url
        ]);
        
        $this->reset(['name']);
        $this->reset(['image']);
        $this->reset(['oldimage']);
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
            $this->emit('render');
            
        } catch (\Exception $e) {

            $this->emit('categoryDeleted_e');
            $this->emit('render');
        }

    }
    /* End Destroy */
}
