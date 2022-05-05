<div class="container-fluid mt-3">
    <div class="row page-titles flex">
        <div class="flex-1 align-self-center">
            <h4 class="text-themecolor mx-auto">Lista de Deseos</h4>
        </div>

        <div class="relative flex-1 inline-block ml-2 col-2" x-data="{ open: false }">
            <button type="button" x-on:click=" open = true " class="text-gray-500 group inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none" aria-expanded="false">
                <svg class="text-gray-400 group-hover:text-gray-500 h-7 w-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(0, 0, 0, 1);transform:;-ms-filter:">
                    <path d="M21.822,7.431C21.635,7.161,21.328,7,21,7H7.333L6.179,4.23C5.867,3.482,5.143,3,4.333,3H2v2h2.333l4.744,11.385 C9.232,16.757,9.596,17,10,17h8c0.417,0,0.79-0.259,0.937-0.648l3-8C22.052,8.044,22.009,7.7,21.822,7.431z"></path><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="17.5" cy="19.5" r="1.5"></circle>
                </svg>
                @if(Cart::instance('cart')->count() > 0)
                <div class="notify-m"> <span class="heartbit-m"></span>{{Cart::instance('cart')->count()}}</div>
                @endif
            </button>

            <div x-show="open" x-on:click.away=" open = false " class="origin-top-right z-10 absolute right-0 mt-2 px-2 w-screen max-w-md sm:px-0 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="mt-2">
                    <p class="text-base font-bold text-center text-gray-900">
                        Su Carrito de Compras
                    </p>    
                </div>
                <div class="relative grid gap-6 bg-white px-3 py-3 sm:gap-8 sm:p-8 overflow-y-auto h-56">
                    @if(Cart::instance('cart')->count() > 0)
                    @foreach(Cart::instance('cart')->content() as $item)
                    <div class="p-3 flex items-start rounded-lg hover:bg-gray-100">
                        <div class="box-border h-32 w-32 p-2 border-2 flex-1">
                            <img class="w-30 h-30 pt-2" src="{{Storage::url($item->model->image->url)}}" alt="{{$item->model->name}}">
                        </div>
                        <div class="ml-5 justify-center flex-1">
                            <p class="text-base font-bold text-gray-900">
                                {{$item->model->name}}
                            </p>
                            <div class="flex flex-row border h-10 w-24 rounded-lg border-gray-400 relative">
                                <button wire:click.prevent="decreaseQuantity('{{$item->rowId}}')" class="font-semibold border-r w-7 bg-gray-200 hover:bg-red-600 hover:text-white border-gray-400 flex rounded-l focus:outline-none cursor-pointer">
                                    <span class="m-auto">-</span>
                                </button>
                                <input type="text" type="text" value="{{$item->qty}}" disabled data-max="120" pattern="[0-9]" class="md:p-2 p-1 w-11 text-xs md:text-base border-gray-300 focus:outline-none text-center"/>

                                <button wire:click.prevent="increaseQuantity('{{$item->rowId}}')" class="font-semibold border-l w-7 bg-gray-200 hover:bg-red-600 hover:text-white border-gray-400 flex rounded-r focus:outline-none cursor-pointer">
                                    <span class="m-auto">+</span>
                                </button>
                            </div> 
                            <p class="mt-2 text-center text-sm font-bold text-gray-700">
                                {{$item->subtotal}}$
                            </p>
                        </div>
                        <div class="box-border pl-5 py-5 flex-1">
                            <button type="button" class="" wire:click.prevent="destroy('{{$item->rowId}}')">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(0, 0, 0, 1);transform:;-ms-filter:"><path d="M6 7C5.447 7 5 7 5 7v13c0 1.104.896 2 2 2h10c1.104 0 2-.896 2-2V7c0 0-.447 0-1 0H6zM16.618 4L15 2 9 2 7.382 4 3 4 3 6 8 6 16 6 21 6 21 4z"></path></svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p class="text-base font-bold text-center text-gray-900">
                        Carrito de compras vacio
                    </p>
                    @endif    
                </div>
                <div class="px-3 py-5 bg-gray-20 sm:px-4 sm:py-8">
                    <div class="p-3 flex justify-between">
                        <span class="text-gray-800 text-lg font-bold">Total: </span>
                        <span class="text-gray-800 text-lg font-bold">{{Cart::instance('cart')->total()-Cart::instance('cart')->tax()}}$</span>
                    </div>
                    <div class="p-3 flex justify-between">
                        <span class="text-gray-800 text-lg">Tasa del día:</span>
                        <span class="text-gray-800 text-lg">@foreach ($dollar as $d){{number_format($d->price, 2)}}@endforeach Bs.F</span>
                    </div>
                    <div class="p-3 flex justify-between">
                        <span class="text-gray-800 text-lg">Referencia:</span>
                        <span class="text-gray-800 text-lg">@foreach ($dollar as $d){{number_format(round(($d->price*Cart::instance('cart')->total()),2),2)}}@endforeach Bs.F</span>
                    </div>
                    <div class="mt-2 flex text-md">
                        <a href="/cart" class="flex-1 rounded-lg border border-gray-800 shadow-md p-2 ml-2 text-gray-800 hover:bg-red-600 hover:text-white text-base text-center max-h-10">Ver Carrito</a>
                        @if(Cart::instance('cart')->count() > 0)
                        <a href="javascript:void(0)" wire:click.prevent="checkout()" class="flex-1 rounded-lg border border-gray-800 shadow-md p-2 ml-2 text-gray-800 hover:bg-red-600 hover:text-white text-base text-center max-h-10">Pagar</a>
                        @else
                        <button class="flex-1 rounded-lg border border-gray-800 shadow-md p-2 ml-2 text-gray-800 text-base text-center max-h-10" disabled="true">Pagar</button>
                        @endif
                        <a href="javascript:void(0)" wire:click.prevent="destroyAll()" class="flex-1 rounded-lg border border-gray-800 shadow-md p-2 xs:p-1 xs:text-xs ml-2 text-gray-800 hover:bg-red-600 hover:text-white text-base text-center max-h-10">Vaciar Carrito</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Info box Content -->
    <!-- ============================================================== -->
    <div class="container mt-4">
        @if(Cart::instance('wishlist')->content()->count() > 0)
        <div class="row">
            <!-- Column -->
            <div class="col-md-9 col-lg-9">
                <div class="card shadow-md">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Su lista de deseos ({{Cart::instance('wishlist')->count()}} artículos)</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table product-overview">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Información del producto</th>
                                        <th>Precio</th>
                                        <th style="text-align:center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Cart::instance('wishlist')->content() as $item)
                                    <tr>
                                        <td width="150"><img src="{{Storage::url($item->model->image->url)}}" alt="{{$item->model->name}}" width="80"></td>
                                        <td width="400">
                                            <h5 class="font-500">{{$item->model->name}}</h5>
                                            <p>{{$item->model->details}}</p>
                                        </td>
                                        <td>{{$item->model->price}}$</td>
                                        <td align="center" colspan="2" width="150" class="flex">
                                            <a href="javascript:void(0)" class="text-md text-gray-900 ml-3 flex-1" wire:click.prevent="moveProductFromWishlistToCart('{{$item->rowId}}')" wire:loading.attr="disabled" title="Añadir al carrito"><i class="ti-shopping-cart text-xl"></i></a>
                                            <a href="javascript:void(0)" class="text-md flex-1" wire:click="removeFromWishlist('{{$item->rowId}}')" title="Eliminar"><i class="ti-trash text-dark text-xl"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            
                            <a href="/"> <button class="btn btn-dark btn-outline"><i class="fa fa-arrow-left"></i> Tienda</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-3 col-lg-3">
                <div class="card shadow-md">
                    <div class="card-body">
                        <h5 class="card-title">Resumen</h5>
                        <hr>
                        <small>Precio total</small>
                        <h2>{{Cart::instance('wishlist')->total()-Cart::instance('wishlist')->tax()}} dólares</h2>
                        <hr>
                        <small>Tasa del día</small>
                        <h4>@foreach ($dollar as $d){{number_format($d->price, 2)}}@endforeach Bs.F</h4>
                        <hr>
                        <small>Precio total</small>
                        <h4>@foreach ($dollar as $d){{number_format(round(($d->price*Cart::instance('wishlist')->total()),2),2)}}@endforeach Bs.F</h4>
                        <hr>
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
        @push('scripts')
        <script>
            @if (session()->has('info'))
                $.toast({
                    heading: 'Notificación',
                    text: '{{session('info')}}',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'success',
                    hideAfter: 3500, 
                    stack: 6
                }); 
            @endif
        </script>   
    @endpush
    </div>
    @else
        <div class="text-center" style="padding:30px 0;">
            <h1>La lista de deseos está vacía!</h1>
            <p>Añadir elemento a ella ahora</p>
            <a href="/" class="btn btn-success">Tienda</a>
        </div>
    @endif
</div>
