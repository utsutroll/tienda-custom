<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminSubcategoryComponent extends Component
{
    /* Variables */
    public $name;
    public $category_id;
    public $slug='';
    public $subcategory_id;
    public $view = 'addSubcategory';
    /* End Variables */

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $categories = Category::all();

        $subcategories = Subcategory::all();

        return view('livewire.admin.admin-subcategory-component', compact('subcategories', 'categories'))->layout('layouts.base-a');
    }

    /* Create */
    public function create()
    {
        $this->reset(['name']);
        $this->reset(['category_id']);

    }

    protected $rules = [
        'name' => 'required|regex:/^[\pL\s\-]+$/u|max:30|unique:subcategories',   
        'category_id' => 'required'    
    ];

    protected $validationAttributes = [
        'name' => 'Subcategoría',
        'category_id' => 'Categoría'
    ];

    public function save(){
        
        $this->validate();

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
            Subcategory::create([
                'name' => $this->name,
                'category_id' => $this->category_id,
                'slug' => Str::slug($this->name)
            ]);

            $this->reset(['name']);
            $this->reset(['category_id']);

            $this->emit('render');

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
        $this->category_id = $subcategory->category_id;
        $this->slug = '';
  
    }

    public function update()
    {
        $this->validate([
            'name' => "required|min:1|unique:subcategories,name,$this->subcategory_id",  
            'category_id' => "required" 
        ]);

        $subcategory = Subcategory::findOrFail($this->subcategory_id);                 

        $this->slug = Str::slug($this->name);

        if($subcategory->slug == $this->slug & $subcategory->category_id == $this->category_id) 
        {
            $this->emit('slugValidate');
            $this->slug = '';
        }
        else 
        {
            

            $subcategory->update([
                'name' => $this->name,
                'category_id' => $this->category_id,
                'slug' => Str::slug($this->name)
            ]);
            
            $this->reset(['name']);
            $this->reset(['category_id']);
            $this->emit('subcategoryEdited');
        }
    }
    /* End Edit/Update */

    /* Destroy */

    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);

        try {
            $subcategory->delete();
            $this->emit('subcategoryDeleted');
            
        } catch (\Exception $e) {

            $this->emit('subcategoryDeleted_e');
        }
    }
    /* End Destroy */
}
