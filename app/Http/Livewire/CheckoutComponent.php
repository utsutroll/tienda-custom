<?php

namespace App\Http\Livewire;

use App\Events\OrderEvent;
use App\Models\DollarRate;
use App\Models\Order;
use App\Models\CharacteristicProductOrder;
use App\Models\Product;
use App\Models\User;
use App\Notifications\OrderNotification;
use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CheckoutComponent extends Component
{   
    public $firstname;
    public $lastname;
    public $mobile;
    public $cedula;
    public $price_bs;

    public function render()
    {
        $dollar = DollarRate::all();
        $this->verifyforCheckout();
        return view('livewire.checkout-component',compact('dollar'))->layout('layouts.base');
    }

    protected $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'mobile' => 'required|min:1|numeric',
        'cedula' => 'required|min:1|numeric',
    ];

    protected $validationAttributes = [
        'firstname'=>'Nombre',
        'lastname'=>'Apellido',
        'mobile'=>'Télefono',
        'cedula'=>'Cédula',
    ];

    public function placeOrder()
    {
        $this->validate();
        
        $dollarr = DollarRate::find(1);
        $this->price_bs = $dollarr->price*session()->get('checkout')['total'];

        foreach(Cart::instance('cart')->content() as $item)
        {
            $stock_product = Product::find($item->id);
            if ($stock_product->stock < $item->qty) {
                
               session()->flash('info', 'El producto: '.$stock_product->name.' se quedó sin stock. Hay Disponible: '.$stock_product->stock.' ');
               return redirect()->to('cart'); 
               die();
            }
        }

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->total = session()->get('checkout')['total'];
        $order->total_bs = $this->price_bs;
        $order->cedula = $this->cedula;
        $order->firstname = $this->firstname;
        $order->lastname = $this->lastname;
        $order->mobile = $this->mobile;
        $order->status= "ordered";
        $order->is_shipping_diferent= 0;
        $order->save();

        foreach(Cart::instance('cart')->content() as $item)
        {
            $orderItem = new CharacteristicProductOrder();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->save();
        }

        event(new OrderEvent($order));

        return redirect()->route('sendpayment',['order_id'=>$order->id]);

    }

    public function cancelCheckout()
    {
        session()->forget('checkout');
        $this->emit('cancelCheck'); 
        return redirect()->route('cart');
    }

    public function verifyforCheckout()
    {
        if(!Auth::check())
        {
            return redirect()->route('login');
        }
        else if(!session()->get('checkout'))
        {
            return redirect()->route('cart');
        }
    }
}
