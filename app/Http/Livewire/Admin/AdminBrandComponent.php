<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminBrandComponent extends Component
{
    /* Variables */
    public $name;
    public $slug='';
    public $brand_id;
    public $view = 'addBrand';
    /* End Variables */

    /* Table */

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $brands = Brand::all();

        return view('livewire.admin.admin-brand-component', compact('brands'))->layout('layouts.base-a');
    }

    /* End Table */

    /* Create */
    public function create()
    {
        $this->reset(['name']);
        $this->slug = '';
    }

    protected $rules = [
        'name' => 'required|min:1|unique:brands'   
    ];

    protected $validationAttributes = [
        'name' => 'Marca'
    ];

    public function save(){
        
        $this->validate();

        $this->emit('render');
    
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name)
        ]);

        $this->reset(['name']);
        $this->emit('render');
        $this->emit('brandAdded');
        
    }
    /* End Create  */

    /* Edit/Update */

    public function edit($id)
    {
        $brand = Brand::find($id);

        $this->brand_id = $id;
        $this->name = $brand->name;
        $this->slug = '';
  
    }

    public function update()
    {
        $this->validate([
            'name' => "required|min:1|unique:brands,name,$this->brand_id"
        ]);

        $this->emit('render');

        $brand = Brand::find($this->brand_id);

        $brand->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name)
        ]);
            
        $this->reset(['name']);
        $this->emit('brandEdited');
        
    }
    /* End Edit/Update */

    /* Destroy */

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        try {
            $brand->delete();
            $this->emit('brandDeleted');
            $this->emit('render');
            
        } catch (\Exception $e) {

            $this->emit('brandDeleted_e');
            $this->emit('render');
        }
    }
    /* End Destroy */
}
