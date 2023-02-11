<div>
    @if(Cart::instance('wishlist')->count() > 0)
    <div class="overflow-x-auto relative my-10 mx-2 md:mx-10 lg:mx-20">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-t border-gray-300">
            <thead class="text-xs text-gray-700 uppercase border-b border-gray-300 bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6 text-center">
                        Remover
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Imágen
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Producto Unitario
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Precio
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Opciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($wishlists as $items)

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-4 px-6 text-center">
                            <a href="javascript:void(0)"  wire:click="removeFromWishlist('{{$items->rowId}}')" title="Remover"><i class="far fa-times-circle"></i></a>
                        </td>
                        <td class="py-4 px-6">
                            <img src="{{ Storage::url($items->options->url) }}" class="inline-block w-14" alt="{{ $items->name }}">
                        </td>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $items->name }} {{ $items->options->brand }}
                        </th>
                        <td class="py-4 px-6">
                            @foreach ($dollar as $d){{ $d->price*round(($items->price), 2) }}@endforeach Bs
                        </td>
                        <td class="py-4 px-6">
                            <a href="{{route('product.details',['slug'=>$items->options->slug])}}" title="Agregar al Carrito de Compras"><i class="far fa-shopping-cart"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <section id="cart-add" class="section-p1">
        <div id="coupon">
            {{-- <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter your Coupon">
                <button class="normal">Aply</button>
            </div> --}}
        </div>

        <div id="subtotal">
            <h3>Resúmen de la Lista de Deseos</h3>
            <table>
                {{-- <tr>
                    <td>Precio total</td>
                    <td>{{ Cart::instance('cart')->total()-Cart::instance('wishlist')->tax() }} dólares</td>
                </tr> --}}
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
        <div class="h-screen my-auto text-center" style="padding:30px 0;">
            <h1 class="text-4xl mt-5 font-medium text-gray-800">La lista de deseos está vacía!</h1>
            <p class="my-4 marker:text-base font-bold">Añadir elemento ahora</p>
            <a href="{{ route('shop') }}" class="rounded-md text-white text-base font-semibold p-3 bg-teal-400 hover:bg-teal-700">Ir al Catálogo</a>
        </div>
    @endif

    @push('scripts')
    @endpush
</div>
