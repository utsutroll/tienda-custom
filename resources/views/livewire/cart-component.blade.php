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
        @if(Cart::instance('cart')->count() > 0)
        {{-- <table width="100%">
            <thead>
                <tr>
                    <td>Remover</td>
                    <td>Imágen</td>
                    <td>Producto</td>
                    <td>Precio</td>
                    <td>Cantidad</td>
                    <td>Subtotal</td>
                </tr>
            </thead>

            <tbody>
                @foreach(Cart::instance('cart')->content() as $item)
                <tr>
                    <td><a href="javascript:void(0)" wire:click.prevent="destroy('{{$item->rowId}}')"><i class="fas fa-times-circle"></i></a></td>
                    <td><img src="{{Storage::url($item->model->image)}}" alt="{{$item->name}}"></td>
                    <td>{{$item->model->product->name}} {{$item->model->product->brand->name}} {{$item->model->characteristic->name}}</td>
                    <td>{{$item->price}}$</td>
                    <td>
                        <div class="flex flex-row border h-7 w-21 rounded-lg border-gray-400 relative">
                            <button wire:click.prevent="decreaseQuantity('{{$item->rowId}}')" class="font-semibold border-r w-5 bg-gray-200 hover:bg-red-600 hover:text-white border-gray-400 flex rounded-l focus:outline-none cursor-pointer">
                                <span class="m-auto">-</span>
                            </button>
                            <input type="text" type="text"value="{{$item->qty}}" disabled data-max="120" pattern="[0-9]" class="md:p-2 p-1 w-11 text-xs md:text-base border-gray-300 focus:outline-none text-center"/>

                            <button  wire:click.prevent="increaseQuantity('{{$item->rowId}}')" class="font-semibold border-l w-5 bg-gray-200 hover:bg-red-600 hover:text-white border-gray-400 flex rounded-r focus:outline-none cursor-pointer">
                                <span class="m-auto">+</span>
                            </button>
                        </div>
                    </td>
                    <td>{{round(($item->subtotal),2)}}$</td>
                </tr>
                @endforeach
            </tbody>
        </table> --}}

        <div class="container">
            <div class="flex flex-wrap -mx-4">
               <div class="w-full px-4">
                  <div class="max-w-full overflow-x-auto">
                     <table class="table-auto w-full">
                        <thead>
                           <tr class="bg-primary text-center">
                              <th class=" w-1/6 min-w-[160px] text-lg font-semibold py-4 lg:py-7 px-3 lg:px-4">
                                 Remover
                              </th>
                              <th class=" w-1/6 min-w-[160px] text-lg font-semibold py-4 lg:py-7 px-3 lg:px-4">
                                 Imágen
                              </th>
                              <th class=" w-1/6 min-w-[160px] text-lg font-semibold py-4 lg:py-7 px-3 lg:px-4">
                                 Producto
                              </th>
                              <th class=" w-1/6 min-w-[160px] text-lg font-semibold py-4 lg:py-7 px-3 lg:px-4">
                                 Precio
                              </th>
                              <th class=" w-1/6 min-w-[160px] text-lg font-semibold py-4 lg:py-7 px-3 lg:px-4">
                                 Cantidad
                              </th>
                              <th class=" w-1/6 min-w-[160px] text-lg font-semibold py-4 lg:py-7 px-3 lg:px-4">
                                 Subtotal
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                        @foreach(Cart::instance('cart')->content() as $item) 
                            <tr>
                                <td class="text-start text-dark font-medium text-base py-5 px-2 bg-white border-b border-[#E8E8E8]">
                                 <a href="javascript:void(0)" wire:click.prevent="destroy('{{$item->rowId}}')"><i class="fas fa-times-circle"></i></a>
                              </td>
                              <td class="text-center text-dark font-medium text-base py-5 px-2 bg-white border-b border-[#E8E8E8]">
                                 <img src="{{Storage::url($item->model->image)}}" class="inline-block" alt="{{$item->name}}">
                              </td>
                              <td class="text-center text-dark font-medium text-base py-5 px-2 bg-white border-b border-[#E8E8E8]">
                                 {{$item->model->product->name}} {{$item->model->product->brand->name}} {{$item->model->characteristic->name}}
                              </td>
                              <td class="text-center text-dark font-medium text-base py-5 px-2 bg-white border-b border-[#E8E8E8]">
                                 {{$item->price}}$
                              </td>
                              <td class="text-center text-dark font-medium text-base py-5 px-2 bg-white border-b border-[#E8E8E8]">
                                 <div class="flex flex-row h-9 w-22 rounded-lg border-gray-400 relative">
                                    <button wire:click.prevent="decreaseQuantity('{{$item->rowId}}')" class="font-semibold border-r w-10 bg-gray-200 hover:bg-red-600 hover:text-white border-gray-400 flex rounded-l focus:outline-none cursor-pointer">
                                        <span class="m-auto">-</span>
                                    </button>
                                    <input type="text" type="text"value="{{$item->qty}}" disabled data-max="120" pattern="[0-9]" class="md:p-2 p-1 w-11 text-xs md:text-base border-gray-300 focus:outline-none text-center"/>
        
                                    <button  wire:click.prevent="increaseQuantity('{{$item->rowId}}')" class="font-semibold border-l w-10 bg-gray-200 hover:bg-red-600 hover:text-white border-gray-400 flex rounded-r focus:outline-none cursor-pointer">
                                        <span class="m-auto">+</span>
                                    </button>
                                </div>
                              </td>
                              <td class="text-center text-dark font-medium text-base py-5 px-2 bg-white border-b border-[#E8E8E8]">
                                 {{round(($item->subtotal),2)}}$
                              </td>
                           </tr>
                        @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
    </section>

    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter your Coupon">
                <button class="normal">Aply</button>
            </div>
        </div>

        <div id="subtotal">
            <h3>Resumen del carrito</h3>
            <table>
                <tr>
                    <td>Precio total</td>
                    <td>{{ Cart::instance('cart')->total()-Cart::instance('cart')->tax() }} dólares</td>
                </tr>
                <tr>
                    <td>Tasa del día</td>
                    <td>@foreach ($dollar as $d){{ number_format($d->price, 2) }}@endforeach Bs</td>
                </tr>
                <tr>
                    <td><strong>Precio total</strong></td>
                    <td><strong>@foreach ($dollar as $d){{number_format(round(($d->price*Cart::instance('cart')->total()),2),2)}}@endforeach Bs</strong></td>
                </tr>
            </table>
            <button class="normal" wire:click.prevent="checkout">Comprar</button>
        </div>
    </section>
    @else
        <div class="text-center" style="padding:30px 0;">
            <h1>Su carrito está vacío!</h1>
            <p>Añadir elemento a él ahora</p>
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
    @endpush
</div>

