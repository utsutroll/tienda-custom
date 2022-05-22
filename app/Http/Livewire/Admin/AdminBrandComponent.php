<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class AdminBrandComponent extends Component
{
    /* Variables */
    public $search = '';
    public $entries = '5';
    public $sort = 'id';
    public $direcction = 'desc';
    public $name;
    public $slug='';
    public $brand_id;
    public $view = 'addBrand';
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
        $brands = Brand::where('name', 'LIKE', "%{$this->search}%")
                        ->orderBy($this->sort, $this->direcction)
                        ->paginate($this->entries);

        return view('livewire.admin.admin-brand-component', compact('brands'))->layout('layouts.base-a');
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
        'name' => 'required|min:1|unique:brands'   
    ];

    protected $validationAttributes = [
        'name' => 'Marca'
    ];

    public function save(){
        
        $this->validate();

    
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
            
        } catch (\Exception $e) {

            $this->emit('brandDeleted_e');
        }
    }
    /* End Destroy */
}
