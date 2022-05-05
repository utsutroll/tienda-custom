<?php

namespace App\Http\Livewire\Admin;

use App\Models\Wallet;
use Livewire\Component;
use Livewire\WithPagination;

class AdminWalletComponent extends Component
{
    /* Variables */
    public $search = '';
    public $entries = '5';
    public $sort = 'id';
    public $direcction = 'desc';
    public $type;
    public $wallet_email;
    public $name;
    public $wallet_id;
    public $view = 'addWallet';
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
        $wallets = Wallet::where('type', 'LIKE', "%{$this->search}%")
                                ->orWhere('wallet_email', 'LIKE', "%{$this->search}%")
                                ->orWhere('name', 'LIKE', "%{$this->search}%")
                                ->orderBy($this->sort, $this->direcction)
                                ->paginate($this->entries);

        return view('livewire.admin.admin-wallet-component', compact('wallets'))->layout('layouts.base-a');
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
            
        } catch (\Exception $e) {

            $this->emit('walletDeleted_e');
        }

    }
    /* End Destroy */
}
