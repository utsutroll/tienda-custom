<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AdminSubcategoryComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = "bootstrap";
    
    /* Variables */
    public $name;
    public $category_id;
    public $imagen;
    public $image;
    public $oldimage;
    public $slug='';
    public $subcategory_id;
    public $view = 'addSubcategory';

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

    public function updatedImage()
    {
        $this->validate([
            'image' => 'required|image', // 1MB Max
        ]);
    }

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $categories = Category::all();

        $subcategories = DB::table('subcategories')
                            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
                            ->select(
                                'subcategories.id AS id', 
                                'subcategories.name AS subcategory',
                                'subcategories.url AS url',
                                'categories.name AS category',
                            )
                            ->when($this->search, function($query) {
                                return $query->where(function ($query) {
                                    $query->where('subcategory', 'like', '%' .$this->search. '%')
                                        ->where('category', 'like', '%' .$this->search. '%');
                                });
                            })
                            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');


        $subcategories = $subcategories->paginate($this->entries);

        return view('livewire.admin.admin-subcategory-component', compact('subcategories', 'categories'))->layout('layouts.base-a');
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
        $this->reset(['imagen']);
        $this->reset(['category_id']);

    }

    protected $rules = [
        'name' => 'required|regex:/^[\pL\s\-]+$/u|max:30|unique:subcategories',   
        'category_id' => 'required',  
        'imagen' => 'required|image'    
    ];

    protected $validationAttributes = [
        'name' => 'Subcategoría',
        'category_id' => 'Categoría',
        'image' => 'Imágen',
        'imagen' => 'Imágen'
    ];

    public function save(){
        
        $this->validate();

        $this->emit('render');

        $this->slug = Str::slug($this->name);
        $subcategory = Subcategory::where('slug', $this->slug)
                                    ->Where('category_id', $this->category_id);
        

        if ($subcategory->count() > 0) 
        {
            $this->emit('slugValidate');
            $this->slug = '';

        }
        else 
        {
            $this->imagen->store('icons'); 
            $url = $this->imagen->store('icons'); 

            Subcategory::create([
                'name' => $this->name,
                'category_id' => $this->category_id,
                'slug' => Str::slug($this->name),
                'url' => $url,
            ]);

            $this->reset(['name']);
            $this->reset(['category_id']);
            $this->reset(['imagen']);

            $this->emit('subcategoryAdded');
        }
    }
    /* End Create  */

    /* Edit/Update */

    public function edit($id)
    {
        $subcategory = Subcategory::find($id);

        $this->subcategory_id = $id;
        $this->name = $subcategory->name;
        $this->image = $subcategory->url;
        $this->oldimage = $subcategory->url;
        $this->category_id = $subcategory->category_id;
        $this->slug = '';
  
    }

    public function update()
    {
        $this->validate([
            'name' => "required|min:1|unique:subcategories,name,$this->subcategory_id",  
            'category_id' => "required|unique:subcategories,category_id,$this->subcategory_id",  
            'image' => 'required|image' 
        ]);

        $subcategory = Subcategory::findOrFail($this->subcategory_id);                 

        if ($subcategory->url == '') {

            $this->image->store('icons');
            $url = $this->image->store('icons');

        }else {
            
            Storage::disk('public')->delete($subcategory->url);
            $this->image->store('icons');
            $url = $this->image->store('icons');
        } 

        $subcategory->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'slug' => Str::slug($this->name),
            'url' => $url
        ]);
        
        $this->reset(['name']);
        $this->reset(['image']);
        $this->reset(['category_id']);
        $this->emit('subcategoryEdited');
        
    }
    /* End Edit/Update */

    /* Destroy */

    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);

        try {
            $subcategory->delete();
            $this->emit('subcategoryDeleted');
            $this->emit('render');
            
        } catch (\Exception $e) {

            $this->emit('subcategoryDeleted_e');
            $this->emit('render');
        }

    }
    /* End Destroy */
}
