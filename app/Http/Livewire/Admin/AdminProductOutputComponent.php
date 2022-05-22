<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\CharacteristicProductOutput;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductOutputComponent extends Component
{
    /* Variables */
    public $search = '';
    public $entries = '25';
    public $sort = 'created_at';
    public $direcction = 'desc';
    public $status_p;
    /* End Variables */

    /* Table */

    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
            $this->resetPage();
    }

    protected $queryString = [
        'search' => ['except' => ''],
        'entries' => ['except' => '25']
    ];


    protected $listeners = ['render', 'render'];

    public function render()
    {
        $products = CharacteristicProductOutput::where('created_at', 'LIKE', "%{$this->search}%")
                            ->orderBy($this->sort, $this->direcction)
                            ->paginate($this->entries);
                            
        return view('livewire.admin.admin-product-output-component', compact('products'));
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
}
