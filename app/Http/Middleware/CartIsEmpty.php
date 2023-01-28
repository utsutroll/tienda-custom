<?php

namespace App\Http\Middleware;

use Closure;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartIsEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $cart = Cart::instance('cart')->count();

        if ($cart < 1){
            Session::flash('message', 'No hay productos en el carrito de compras');
            return redirect()->route('cart'); 
        }

        return $next($request);
    }
}
