<?php

namespace App\Http\Livewire\Admin;

use App\Models\Bank;
use App\Models\BankAccount;
use Livewire\Component;

class AdminBankAccountComponent extends Component
{
    /* Variables */
    public $payment_id;
    public $type_account;
    public $account;
    public $cedula;
    public $phone;
    public $beneficiary;
    public $bank_id;
    public $type_d;
    public $pm;
    public $bankn = '';
    public $code = '';
    public $view = 'addBankAccount';
    /* End Variables */

    /* Table */

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $banks = Bank::all();
        $payments = BankAccount::all();

        return view('livewire.admin.admin-bank-account-component', compact('banks', 'payments'))->layout('layouts.base-a');
    }

    /* End Table */

    /* Create */
    public function create()
    {
        $this->reset(['type_account']);
        $this->reset(['account']);
        $this->reset(['cedula']);
        $this->reset(['phone']);
        $this->reset(['beneficiary']);
        $this->reset(['bank_id']);
        $this->reset(['type_d']);
        $this->reset(['pm']);
    }

    protected $rules = [
        'type_account' => 'required',   
        'account' => 'required|numeric|unique:bank_accounts|digits:20',   
        'cedula' => 'required|min:1|numeric',   
        'phone' => 'required|min:1|numeric',   
        'beneficiary' => 'required',   
        'bank_id' => 'required',   
        'type_d' => 'required',   
        'pm' => 'required',   
    ];

    protected $validationAttributes = [
        'type_account' => 'Tipo de Cuenta',
        'account' => 'Nro. de Cuenta',
        'cedula' => 'Cédula',
        'phone' => 'Celular',
        'beneficiary' => 'Beneficiario',
        'bank_id' => 'Banco',
        'type_d' => 'Tipo de Documento',
        'pm' => 'Pago Móvil'
    ];

    public function save(){
        
        $this->validate();

        $this->emit('render');

        BankAccount::create([
            'type_account' => $this->type_account,
            'account' => $this->account,
            'cedula' => $this->cedula,
            'phone' => $this->phone,
            'beneficiary' => $this->beneficiary,
            'bank_id' => $this->bank_id,
            'type_d' => $this->type_d,
            'pm' => $this->pm
        ]);

        $this->reset(['type_account']);
        $this->reset(['account']);
        $this->reset(['cedula']);
        $this->reset(['phone']);
        $this->reset(['beneficiary']);
        $this->reset(['bank_id']);
        $this->reset(['type_d']);
        $this->reset(['pm']);

        $this->emit('render');

        $this->emit('paymentAdded');
    }
    /* End Create  */

    /* Edit/Update */

    public function edit($id)
    {
        $payment = BankAccount::find($id);

        $this->payment_id = $id;
        $this->type_account = $payment->type_account;
        $this->account = $payment->account;
        $this->cedula = $payment->cedula;
        $this->phone = $payment->phone;
        $this->beneficiary = $payment->beneficiary;
        $this->bank_id = $payment->bank_id;
        $this->type_d = $payment->type_d;
        $this->pm = $payment->pm;
  
    }

    public function update()
    {
        $this->validate([
            'type_account' => 'required',   
            'account' => "required|min:20|numeric|max:20|unique:bank_accounts,account,$this->payment_id",   
            'cedula' => 'required|min:1|numeric',   
            'phone' => 'required|min:1|numeric',   
            'beneficiary' => 'required',   
            'bank_id' => 'required',   
            'type_d' => 'required',   
            'pm' => 'required',    
        ]);

        $this->emit('render');

        $payment = BankAccount::find($this->payment_id);

        $payment->update([
            'type_account' => $this->type_account,
            'account' => $this->account,
            'cedula' => $this->cedula,
            'phone' => $this->phone,
            'beneficiary' => $this->beneficiary,
            'bank_id' => $this->bank_id,
            'type_d' => $this->type_d,
            'pm' => $this->pm
        ]);
        
        $this->reset(['type_account']);
        $this->reset(['account']);
        $this->reset(['cedula']);
        $this->reset(['phone']);
        $this->reset(['beneficiary']);
        $this->reset(['bank_id']);
        $this->reset(['type_d']);
        $this->reset(['pm']);

        $this->emit('paymentEdited');
        
    }
    /* End Edit/Update */

    /* Show */
    public function show($id)
    {
        $payment = BankAccount::find($id);

        $this->type_account = $payment->type_account;
        $this->account = $payment->account;
        $this->cedula = $payment->cedula;
        $this->phone = $payment->phone;
        $this->beneficiary = $payment->beneficiary;
        $this->bankn = $payment->bank->name;
        $this->code = $payment->bank->code;
        $this->type_d = $payment->type_d;
        $this->pm = $payment->pm;

  
    }
    /* End Show */

    /* Destroy */

    public function destroy($id)
    {
        $payment = BankAccount::findOrFail($id);

        try {
            $payment->delete();
            $this->emit('paymentDeleted');
            
        } catch (\Exception $e) {

            $this->emit('paymentDeleted_e');
        }

    }
    /* End Destroy */
}
