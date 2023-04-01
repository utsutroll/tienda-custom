<?php

namespace App\Http\Livewire\Admin;

use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AdminWalletComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    
    /* Variables */
    public $type;
    public $wallet_email;
    public $name;
    public $wallet_id;
    public $view = 'addWallet';

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
        $wallets = DB::table('wallets')
                        ->select('id', 'name', 'type', 'wallet_email')
                        ->when($this->search, function($query) {
                            return $query->where(function ($query) {
                                $query->where('name', 'like', '%' .$this->search. '%')
                                    ->where('type', 'like', '%' .$this->search. '%')
                                    ->where('wallet_email', 'like', '%' .$this->search. '%');
                            });
                        })
                        ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');


        $wallets = $wallets->paginate($this->entries);

        return view('livewire.admin.admin-wallet-component', compact('wallets'))->layout('layouts.base-a');
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
        $this->reset(['type']);
        $this->reset(['wallet_email']);
        $this->reset(['name']);
    }

    protected $rules = [
        'type' => 'required',   
        'wallet_email' => 'required|unique:wallets',   
        'name' => 'required'   
    ];

    protected $validationAttributes = [
        'type' => 'Tipo de Billetera',
        'wallet_email' => 'Billetera',
        'name' => 'Plataforma'
    ];

    public function save(){
        
        $this->validate();

        $this->emit('render');

        Wallet::create([
            'type' => $this->type,
            'wallet_email' => $this->wallet_email,
            'name' => $this->name
        ]);

        $this->reset(['type']);
        $this->reset(['wallet_email']);
        $this->reset(['name']);

        $this->emit('render');

        $this->emit('walletAdded');
    }
    /* End Create  */

    /* Edit/Update */

    public function edit($id)
    {
        $wallet = Wallet::find($id);

        $this->wallet_id = $id;
        $this->type = $wallet->type;
        $this->wallet_email = $wallet->wallet_email;
        $this->name = $wallet->name;
  
    }

    public function update()
    {
        $this->validate([
            'type' => 'required',   
            'wallet_email' => "required|unique:wallets,wallet_email,$this->wallet_id",   
            'name' => 'required'   
        ]);

        $this->emit('render');

        $wallet = Wallet::find($this->wallet_id);

        $wallet->update([
            'type' => $this->type,
            'wallet_email' => $this->wallet_email,
            'name' => $this->name
        ]);
        
        $this->reset(['type']);
        $this->reset(['wallet_email']);
        $this->reset(['name']);

        $this->emit('walletEdited');
        
    }
    /* End Edit/Update */

    /* Destroy */

    public function destroy($id)
    {
        $wallet = Wallet::findOrFail($id);

        try {
            $wallet->delete();
            $this->emit('walletDeleted');
            $this->emit('render');
            
        } catch (\Exception $e) {

            $this->emit('walletDeleted_e');
            $this->emit('render');
        }

    }
    /* End Destroy */
}
