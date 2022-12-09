<div>
    
    @if(Cart::instance('cart')->count() > 0)
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
                        Producto
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Precio
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Cantidad
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Subtotal
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach(Cart::instance('cart')->content() as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="py-4 px-6 text-center">
                        <a href="javascript:void(0)" wire:click.prevent="destroy('{{$item->rowId}}')"><i class="fas fa-times-circle"></i></a>
                    </td>
                    <td class="py-4 px-6">
                        <img src="{{Storage::url($item->model->image)}}" class="inline-block w-14" alt="{{$item->name}}">
                    </td>
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->model->product->name }} {{ $item->model->product->brand->name }} {{ $item->model->characteristic->name }}
                    </th>
                    <td class="py-4 px-6">
                        @foreach ($dollar as $d){{ number_format($item->price, 2) }}@endforeach Bs
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex flex-row h-9 w-22 rounded-lg border-gray-400 relative">
                            <button wire:click.prevent="decreaseQuantity('{{$item->rowId}}')" class="font-semibold border border-gray-500 w-10 bg-gray-100 hover:bg-emerald-700 hover:text-white flex focus:outline-none cursor-pointer">
                                <span class="m-auto">-</span>
                            </button>
                            <input type="text" type="text"value="{{$item->qty}}" disabled data-max="120" pattern="[0-9]" class="md:p-2 p-1 w-10 text-xs md:text-base border-t border-b border-r-0 border-l-0 border-gray-500 focus:outline-none text-center"/>

                            <button  wire:click.prevent="increaseQuantity('{{$item->rowId}}')" class="font-semibold border border-gray-500 w-10 bg-gray-100 hover:bg-emerald-700 hover:text-white flex focus:outline-none cursor-pointer">
                                <span class="m-auto">+</span>
                            </button>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        @foreach ($dollar as $d){{ $d->price*round(($item->subtotal),2) }} @endforeach Bs
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
            <h3>Resumen del carrito</h3>
            <table>
                {{-- <tr>
                    <td>Tasa del día</td>
                    <td>@foreach ($dollar as $d){{ number_format($d->price, 2) }}@endforeach Bs</td>
                </tr> --}}
                <tr>
                    <td><strong>Precio total</strong></td>
                    <td><strong>@foreach ($dollar as $d){{number_format(round(($d->price*Cart::instance('cart')->total()),2),2)}}@endforeach Bs</strong></td>
                </tr>
            </table>
            <button class="normal" wire:click.prevent="checkout">Comprar</button>
        </div>
    </section>
    @else
        <div class="h-screen my-auto text-center" style="padding:30px 0;">
            <h1 class="text-4xl mt-5 font-medium text-gray-800">Su carrito está vacío!</h1>
            <p class="my-4 marker:text-base font-bold">Añadir elemento a él ahora</p>
            <a href="{{ route('shop') }}" class="rounded-md text-white text-base font-semibold p-3 bg-emerald-500 hover:bg-emerald-700">Ir al Catálogo</a>
        </div>
    @endif

    @push('scripts')
        <script>
            
            window.livewire.on('cancelCheck',()=>{
                $.toast({
                    heading: 'Notificación',
                    text: 'Se canceló la comprobación de la compra.',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'info',
                    hideAfter: 3500, 
                    stack: 6
                });
            });

            window.livewire.on('cancelPay',()=>{
                $.toast({
                    heading: 'Notificación',
                    text: 'Se Canceló la comprobación del pago.',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'info',
                    hideAfter: 3500, 
                    stack: 6
                });
            });
      
        </script>   
        
        @if (session()->has('info'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: '{{ session('info') }}'
            }); 
        </script>
        @endif
    @endpush
</div>

