<div class="container-fluid mt-3">
    <div class="row page-titles flex">
        <div class="flex-1 align-self-center">
            <h4 class="text-themecolor">Detalle del Producto</h4>
        </div>
        <div class="flex-1">
            <a href="/wishlist" class="text-gray-500 group inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none" aria-expanded="false">
                <svg class="text-gray-400 group-hover:text-gray-500 h-7 w-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(0, 0, 0, 1);transform:;-ms-filter:">
                    <path d="M20.205,4.791c-1.137-1.131-2.631-1.754-4.209-1.754c-1.483,0-2.892,0.552-3.996,1.558 c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412L12,21.414 l8.207-8.207C22.561,10.854,22.562,7.158,20.205,4.791z"></path>
                </svg>
                @if(Cart::instance('wishlist')->count() > 0)
                <div class="notify-m"> <span class="heartbit-m"></span>{{Cart::instance('wishlist')->count()}}</div>
                @endif
            </a>
        
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
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Info box Content -->
    <!-- ============================================================== -->
    @php
        $witems = Cart::instance('wishlist')->content()->pluck('id');
    @endphp
    <div class="row py-8 px-3 md:px-2 lg:px-5">
        <!-- Column -->
        <div class="grid grid-cols-12 lg:grid-cols-1 lg:grid-cols-12 md:gap-2 lg:gap-6">
            <div class="card col-span-12 md:col-span-8 lg:col-span-9 shadow-md">
                <div class="card-body">
                    <h3 class="">{{$product->name}} ({{$product->presentation->name}} {{$product->presentation->medida}})</h3>
                    <h5 class="text-base font-bold">
                        @if ($product->stock == 0)
                        <span class="text-sm text-red-500"> Sin stock</span>   
                        @elseif($product->stock <= 10) 
                        <span class="text-sm text-red-500"> Disponibilidad: {{ $product->stock }}</span>
                        @endif
                    </h5> 
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="white-box text-center"> 
                                @isset($product->image->url)
                                    <img src="{{Storage::url($product->image->url)}}" class="img-responsive" alt="{{$product->name}}">
                                @endisset  
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-6">
                            <h4 class="box-title m-t-40">Descripción del producto</h4>
                            <p>{{$product->details}}</p>

                            @if ($product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                            <h2 class="m-t-40">
                                <span>{{$product->sale_price}}$</span>
                                <del><span class="text-base font-thin line-through">{{$product->price}}$</span></del>
                            </h2>
                            @else
                            <h2 class="m-t-40">{{$product->price}}$</h2>        
                            @endif
                            
                            @if ($product->stock > 0)
                                <div class="flex flex-row border h-10 w-24 rounded-lg border-gray-400 relative my-3">
                                    <button wire:click.prevent="decreaseQuantityD" class="font-semibold border-r w-7 bg-gray-200 hover:bg-red-600 hover:text-white border-gray-400 flex rounded-l focus:outline-none cursor-pointer">
                                        <span class="m-auto">-</span>
                                    </button>
                                    <input type="text" type="text" wire:model="qty" disabled data-max="120" pattern="[0-9]" class="md:p-2 p-1 w-11 text-xs md:text-base border-gray-300 focus:outline-none text-center"/>

                                    <button wire:click.prevent="increaseQuantityD" class="font-semibold border-l w-7 bg-gray-200 hover:bg-red-600 hover:text-white border-gray-400 flex rounded-r focus:outline-none cursor-pointer">
                                        <span class="m-auto">+</span>
                                    </button>
                                </div> 
                                @if ($product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                <button class="btn btn-dark btn-rounded m-r-5" wire:click.prevent="store({{$product->id}}, '{{$product->name}}', {{$product->sale_price}})" wire:loading.attr="disabled" data-toggle="tooltip" title="" data-original-title="Añadir al carrito"><i class="ti-shopping-cart"></i> <button>  
                                @else
                                <button class="btn btn-dark btn-rounded m-r-5" wire:click.prevent="store({{$product->id}}, '{{$product->name}}', {{$product->price}})" wire:loading.attr="disabled" data-toggle="tooltip" title="" data-original-title="Añadir al carrito"><i class="ti-shopping-cart"></i> <button>  
                                @endif    
                            @endif

                            @if ($witems->contains($product->id))
                                <button class="btn btn-dark btn-rounded m-r-5" wire:click.prevent="removeFromWishlist({{$product->id}})" wire:loading.attr="disabled" data-toggle="tooltip" title="" data-original-title="Agregado a la Lista de deseos"><i class="fa fa-heart text-red-600"></i> <button>    
                            @else
                                <button class="btn btn-dark btn-rounded m-r-5" wire:click.prevent="addToWishlist({{$product->id}}, '{{$product->name}}', {{$product->price}})" wire:loading.attr="disabled" data-toggle="tooltip" title="" data-original-title="Añadir a la Lista de Deseos"><i class="fa fa-heart"></i> <button>    
                            @endif

                            @if ($product->stock > 0)    
                                <a href="javascript:void(0)" wire:click.prevent="checkout()" class="btn btn-primary btn-rounded">Comprar ahora </a>
                            @endif    
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h3 class="box-title m-t-40">Información general</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="390">Presentación</td>
                                            <td> {{$product->presentation->name}} {{$product->presentation->medida}}</td>
                                        </tr>
                                        <tr>
                                            <td>Categoría</td>
                                            <td> {{$product->category->name}} </td>
                                        </tr>
                                        <tr>
                                            <td>Etiquetas</td>
                                            <td> 
                                                @foreach ($product->tags as $t)
                                                <a href="{{route('product.tag', ['tag_slug'=>$t->slug])}}" class="badge badge-info"><span>{{$t->name}}</span></a>     
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Contenido Relacionado --}}
            <aside class="col-span-12 md:col-span-5 lg:col-span-3 bg-white text-center shadow-md">
                <h1 class="text-base font-bold text-gray-800 mt-4">Más en {{$product->category->name}}</h1>
                <hr/>
                <ul>
                    @if (count($similares) > 0)
                        @foreach ($similares as $s)
                        <li class="space-y-2 mb-2 justify-center">
                            <div class="block">
                                <a class="flex space-y-2 p-2" href="{{route('product.details',['slug'=>$s->slug])}}">
                                    <img class="w-36 h-20 ml-2 object-cover object-center flex-1" src="{{Storage::url($s->image->url)}}" alt=""/>
                                    <span class="text-sm font-bold mt-3 ml-2 text-gray-900 flex-1">{{$s->price}}$</span>
                                    @if ($s->stock > 0)
                                        <button class="btn btn-dark btn-rounded w-5 h-10 mx-2 my-3 flex-1" wire:click.prevent="store({{$s->id}}, '{{$s->name}}', {{$s->price}})" wire:loading.attr="disabled" title="Añadir al carrito"><i class="ti-shopping-cart"></i> <button>    
                                    @endif
                                    
                                    @if ($witems->contains($s->id))
                                    <button class="btn btn-dark btn-rounded w-5 h-10 mx-2 my-3 flex-1" wire:click.prevent="removeFromWishlist({{$s->id}})" wire:loading.attr="disabled" title="Agregado a la Lista de deseos"><i class="fa fa-heart text-red-600"></i> <button>    
                                    @else
                                    <button class="btn btn-dark btn-rounded w-5 h-10 mx-2 my-3 flex-1" wire:click.prevent="addToWishlist({{$s->id}}, '{{$s->name}}', {{$s->price}})" wire:loading.attr="disabled" title="Añadir a la Lista de Deseos"><i class="fa fa-heart"></i> <button>    
                                    @endif    
                                </a>
                                <h1 class="text-sm font-bold text-gray-900 block">
                                    {{$s->name}} ({{$s->presentation->name}} {{$s->presentation->medida}})
                                </h1>
                            </div>    
                        </li>
                        <hr/>
                        @endforeach    
                    @else
                        <h1 class="text-base text-gray-500 mt-4">No se encontrarón productos similares.</h1>
                    @endif
                </ul>
            </aside>
        </div>
        <!-- Column -->
    </div>
</div>

