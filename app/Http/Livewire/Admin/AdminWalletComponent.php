<?php

namespace App\Http\Livewire\Admin;

use App\Models\Wallet;
use Livewire\Component;

class AdminWalletComponent extends Component
{
    /* Variables */
    public $type;
    public $wallet_email;
    public $name;
    public $wallet_id;
    public $view = 'addWallet';
    /* End Variables */

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $wallets = Wallet::all();

        return view('livewire.admin.admin-wallet-component', compact('wallets'))->layout('layouts.base-a');
    }

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
