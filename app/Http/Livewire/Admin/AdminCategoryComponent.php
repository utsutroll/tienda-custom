<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminCategoryComponent extends Component
{
    /* Variables */
    public $name;
    public $category_id;
    public $view = 'addCategory';
    /* End Variables */

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $categories = Category::all();

        return view('livewire.admin.admin-category-component', compact('categories'))->layout('layouts.base-a');
    }


    /* Create */
    public function create()
    {
        $this->reset(['name']);
    }

    protected $rules = [
        'name' => 'required|regex:/^[\pL\s\-]+$/u|max:30|unique:categories',   
    ];

    protected $validationAttributes = [
        'name' => 'Categoría'
    ];

    public function save(){
        
        $this->validate();

        $this->emit('render');

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
            'name' => "required|alpha|max:30|unique:categories,name,$this->category_id",  
        ]);

        $this->emit('render');

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
            $this->emit('render');
            
        } catch (\Exception $e) {

            $this->emit('categoryDeleted_e');
            $this->emit('render');
        }

    }
    /* End Destroy */
}
