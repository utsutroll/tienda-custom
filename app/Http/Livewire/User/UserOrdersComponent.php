<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserOrdersComponent extends Component
{
    /* Variables */
    public $search = '';
    public $entries = '25';
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
        'entries' => ['except' => '25']
    ];

    public function render()
    {
        $orders = Order::where('user_id',Auth::user()->id)
                        ->orderBy($this->sort, $this->direcction)
                        ->paginate($this->entries);

        return view('livewire.user.user-orders-component',['orders'=>$orders])->layout('layouts.base');
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
        $this->entries = '25';

    }
    /* End Table */
}
