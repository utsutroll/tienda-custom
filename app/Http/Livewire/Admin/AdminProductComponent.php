<?php

namespace App\Http\Livewire\Admin;

use App\Models\Image;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;


class AdminProductComponent extends Component
{
    /* Variables */
    public $search = '';
    public $entries = '5';
    public $sort = 'id';
    public $direcction = 'desc';
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

        $products = Product::where('name', 'LIKE', "%{$this->search}%")
                            ->orderBy($this->sort, $this->direcction)
                            ->paginate($this->entries);

        return view('livewire.admin.admin-product-component', compact('products'));
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

    /* Destroy */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $images = Image::where('imageable_id', $id);

        try {
            $product->delete();
            $images->delete(); 
            
            $this->emit('productDeleted');
            
        } catch (\Exception $e) {

            $this->emit('ProductDeleted_e');
        }

    }
    /*End Destroy*/
}
