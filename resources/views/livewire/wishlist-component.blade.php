<div>
    <section id="page-header" class="about-header">
        <h2>#Let's_talk</h2>
        
        <p>LEAVE A MESSAGE, We love to hear from you!</p>
    </section>

    <section id="cart" class="section-p1">
        @if (session()->has('info'))
            <div class="alert alert-danger mb-4"> <i class="fa fa-exclamation-triangle"></i> {{ session('info') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>        
        @endif
        @if(Cart::instance('wishlist')->count() > 0)
        <table width="100%">
            <thead>
                <tr>
                    <td>Remover</td>
                    <td>Imágen</td>
                    <td>Producto</td>
                    <td>Precio</td>
                </tr>
            </thead>

            <tbody>
                @foreach(Cart::instance('wishlist')->content() as $items)
                <tr>
                    <td><a href="javascript:void(0)"  wire:click="removeFromWishlist('{{$items->rowId}}')"><i class="far fa-time-circle"></i></a></td>
                    <td><img src="{{Storage::url($items->model->image->url)}}" alt="{{$items->name}}"></td>
                    <td>{{$items->name}}</td>
                    <td>{{$items->price}}$</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">
        <div id="coupon">
            {{-- <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter your Coupon">
                <button class="normal">Aply</button>
            </div> --}}
        </div>

        <div id="subtotal">
            <h3>Resumen de la Lista de Deseos</h3>
            <table>
                <tr>
                    <td>Precio total</td>
                    <td>{{ Cart::instance('cart')->total()-Cart::instance('wishlist')->tax() }} dólares</td>
                </tr>
                <tr>
                    <td>Tasa del día</td>
                    <td>@foreach ($dollar as $d){{ number_format($d->price, 2) }}@endforeach Bs</td>
                </tr>
                <tr>
                    <td><strong>Precio total</strong></td>
                    <td><strong>@foreach ($dollar as $d){{number_format(round(($d->price*Cart::instance('wishlist')->total()),2),2)}}@endforeach Bs</strong></td>
                </tr>
            </table>
        </div>
    </section>
    @else
        <div class="text-center" style="padding:30px 0;">
            <h1>La lista de deseos está vacía!</h1>
            <p>Añadir elemento a ella ahora</p>
            <a href="{{ route('shop') }}" class="rounded-md text-white text-base font-semibold p-3 bg-emerald-500 hover:bg-emerald-700">Ir al Catálogo</a>
        </div>
    @endif
</div>
   
