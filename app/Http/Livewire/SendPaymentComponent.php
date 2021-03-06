<?php

namespace App\Http\Livewire;

use App\Events\CancelOrderEvent;
use App\Models\BankAccount;
use App\Models\DollarRate;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Cart;
use DB;

class SendPaymentComponent extends Component
{
    use WithFileUploads;

    public $order_id;
    public $captura;
    public $referencia;
    public $bank_id;
    public $wallet_id;
    public $paymentmode = 'money';
    public $price_bs;
    public $thankyou;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    protected $rules = [
        'reference' => 'reqired|numeric|min:1',
    ];

    protected $validationAttributes = [
        'reference'=>'Referencia',
    ];

    public function sendPayment()
    {

    if($this->paymentmode == "money")
    {
        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $this->order_id;
        $transaction->mode = 'money';
        $transaction->reference = $this->referencia;
        $transaction->save();
    }
    elseif($this->paymentmode == "bank") 
    {
        $this->captura->store('cap'); 
        $url = $this->captura->store('cap');

        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $this->order_id;
        $transaction->bank_id = $this->bank_id;
        $transaction->mode = 'bank';
        $transaction->url = $url;
        $transaction->reference = $this->referencia;
        $transaction->save();
    } 
    else
    {
        $this->captura->store('cap'); 
        $url = $this->captura->store('cap');

        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $this->order_id;
        $transaction->wallet_id = $this->wallet_id;
        $transaction->mode = 'wallet';
        $transaction->url = $url;
        $transaction->reference = $this->referencia;
        $transaction->save();
    }

    Cart::instance('cart')->destroy();
    session()->forget('checkout');
    $this->thankyou = 1;
    }
    
    public function cancelPayment()
    {
        $order = Order::find($this->order_id);
        event(new CancelOrderEvent($order));
        $order->status = "canceled";
        $order->canceled_date = DB::raw('CURRENT_DATE');
        $order->save();  

        session()->forget('checkout');
        $this->emit('cancelPay'); 

        return redirect()->route('cart');

    }

    public function verifyforCheckout()
    {
        if(!Auth::check())
        {
            return redirect()->route('login');
        }
        else if($this->thankyou) 
        {
            return redirect()->route('thankyou');
        }
    }

    public function render()
    {
        $banks = BankAccount::all();
        $wallets = Wallet::all();
        $dollar = DollarRate::all();

        $this->verifyforCheckout();
        return view('livewire.send-payment-component', compact('banks', 'wallets', 'dollar'))->layout('layouts.base');
    }
}
