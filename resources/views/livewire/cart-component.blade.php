<div>
    <div class="container mt-4">
        @if (session()->has('info'))
            <div class="alert alert-danger mb-4"> <i class="fa fa-exclamation-triangle"></i> {{ session('info') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>        
        @endif
        @if(Cart::instance('cart')->count() > 0)
        <div class="row">
            <!-- Column -->
            <div class="col-md-9 col-lg-9">
                <div class="card shadow-md">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Su carro de la compra ({{Cart::instance('cart')->count()}} artículos)</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table product-overview">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Información del producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th style="text-align:center">Total</th>
                                        <th style="text-align:center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach(Cart::instance('cart')->content() as $item)
                                    <tr>
                                        <td width="150"><img src="{{Storage::url($item->model->image->url)}}" alt="{{$item->model->name}}" width="80"></td>
                                        <td width="550">
                                            <h5 class="font-500">{{$item->model->product}}</h5>
                                            <p>{{$item->model->details}}</p>
                                        </td>
                                        <td>{{$item->model->price}}$</td>
                                        <td width="80">
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
                                        <td width="150" align="center" class="font-500">{{round(($item->subtotal),2)}}$</td>
                                        <td align="center"><a href="javascript:void(0)" wire:click.prevent="destroy('{{$item->rowId}}')" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash text-dark"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            @if(Cart::instance('cart')->count() > 0)
                            <a href="#" wire:click.prevent="checkout"> <button class="btn btn-danger pull-right"><i class="fa fa fa-shopping-cart"></i> Pagar</button></a>
                            @else
                            <button class="btn btn-danger pull-right" disabled="true"><i class="fa fa fa-shopping-cart"></i> Pagar</button>
                            @endif
                            
                            <a href="/"> <button class="btn btn-dark btn-outline"><i class="fa fa-arrow-left"></i> Continuar comprando</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-3 col-lg-3">
                <div class="card shadow-md">
                    <div class="card-body">
                        <h5 class="card-title">Resumen del carrito</h5>
                        <hr>
                        <small>Precio total</small>
                        <h2>{{Cart::instance('cart')->total()-Cart::instance('cart')->tax()}} dólares</h2>
                        <hr>
                        <small>Tasa del día</small>
                        <h4>@foreach ($dollar as $d){{number_format($d->price, 2)}}@endforeach Bs.F</h4>
                        <hr>
                        <small>Precio total</small>
                        <h4>@foreach ($dollar as $d){{number_format(round(($d->price*Cart::instance('cart')->total()),2),2)}}@endforeach Bs.F</h4>
                        <hr>
                        <a href="#" wire:click.prevent="checkout"><button class="btn btn-success">Comprar</button></a>
                        <button class="btn btn-secondary btn-outline">Cancelar</button>
                    </div>
                </div>
                <div class="card shadow-md">
                    <div class="card-body">
                        <h5 class="card-title">Para cualquier ayuda</h5>
                        <hr>
                        <h5><i class="ti-mobile"></i> +58-412-5541-056</h5> <small>Por favor, contacte con nosotros si tiene alguna duda.
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="text-center" style="padding:30px 0;">
            <h1>Su carrito está vacío!</h1>
            <p>Añadir elemento a él ahora</p>
            <a href="/" class="btn btn-success">Comprar Ahora</a>
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

