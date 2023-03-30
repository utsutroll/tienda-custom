<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class AdminBrandComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    /* Variables */
    public $name;
    public $slug='';
    public $brand_id;
    public $view = 'addBrand';

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

    /* Table */

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $brands = DB::table('brands')
                        ->select('id', 'name')
                        ->when($this->search, function($query) {
                            return $query->where(function ($query) {
                                $query->where('name', 'like', '%' .$this->search. '%');
                            });
                        })
                        ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');


        $brands = $brands->paginate($this->entries);

        return view('livewire.admin.admin-brand-component', compact('brands'))->layout('layouts.base-a');
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
        $brand = Brand::findOrFail($id);

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

        $this->emit('render');
        
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
