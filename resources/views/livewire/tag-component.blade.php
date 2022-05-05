<div>
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @for ($i = 0; $i < count($sliders); $i++)
            <li data-target="#carousel" data-slide-to="{{$i}}" @if ($i == 0) class="active" @endif></li>
            @endfor
        </ol>

        <div class="carousel-inner" role="listbox">
            @php $n=0 @endphp
            @foreach ($sliders as $s)
            <div @if ($n == 0) class="carousel-item active" @else class="carousel-item" @endif>
                @if ($s->link == '')
                    @isset($s->image->url)
                    <img loading="lazy" class="img-responsive" src="{{Storage::url($s->image->url)}}" alt="{{$s->title}}">    
                    @endisset
                    
                @else
                    @isset($s->image->url)
                    <a href="{{$s->link}}" target="_blank">
                        <img loading="lazy" class="img-responsive" src="{{Storage::url($s->image->url)}}" alt="{{$s->title}}">   
                    </a>     
                    @endisset
                
                @endif
                
                <div class="carousel-caption d-none d-md-block">
                    <h3 style="font-size:2vw;">{{$s->title}}</h3>
                    <p class="m-auto" style="font-size:1vw;">{{$s->subtitle}}</p>
                </div>
            </div>
            @php $n++ @endphp
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </div>
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="p-3 mb-3 bg-white d-flex justify-content-center">
        <div class="form-material flex justify-between">
            <div class="ml-1 input-group flex-2">
                <div class="input-group-prepend">
                    <div class="relative inline-block text-left mr-2" x-data="{ open: false }">
                        <div>
                            <button x-on:click=" open = true " type="button" class="inline-flex justify-center w-full border-t-0 border-b border-l-0 border-r-0 border-gray-200 px-1 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                Filtrar por Categoría
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <div x-show="open" x-on:click.away=" open = false "
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="z-50 origin-top-right absolute mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            
                            <div class="py-1 overflow-y-auto h-80 sm:h-80 md:h-80 lg:h-90" role="none">
                                @foreach($categories as $c) 
                                <a href="{{route('product.category', ['category_slug'=>$c->slug])}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">{{$c->name}}</a>
                                @endforeach 
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="search_box" wire:model="search" class="form-control" placeholder="Buscar &hellip;" />
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
            </div>
            <div class="relative inline-block ml-2 flex-1" x-data="{ open: false }">
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
                                @isset($item->model->image->url)
                                <img class="w-30 h-30 pt-2" src="{{Storage::url($item->model->image->url)}}" alt="{{$item->model->name}}">    
                                @endisset
                                
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

    <!-- Column -->
    {{-- @livewire('offer') --}}
    <!-- Column -->

    <h1 class="text-xl uppercase text-center font-bold py-2 my-3">Etiqueta: {{$tag_name}}</h1>

    @php
        $witems = Cart::instance('wishlist')->content()->pluck('id');
    @endphp
    @if (count($productss) == 0)
    <div class="my-4 text-center">
        <h5 class="text-base text-gray-800">No se Encontraron Productos que Correspondan a la Categoría: {{$tag[0]->name}}</h5>
    </div>    

    @elseif(count($productss) >0)
    
    <div class="px-1 sm:px-2 md:px-3">
        <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-3 md:grid-cols-4 md:gap-4 lg:grid-cols-5 lg:gap-4">  
            @foreach ($productss as $p)
            <div class="">
                <div class="card shadow-md p-2">
                    <div class="card-body">    
                        <div class="img-pro">    
                            <a href="{{route('product.details',['slug'=>$p->slug])}}"> 
                                @isset($p->image->url)
                                    <img loading="lazy" class="img-fluid image" src="{{Storage::url($p->image->url)}}" alt="{{$p->product}}"/>    
                                @endisset
                            </a>
                            <ul class="overlay">
                                @foreach ($p->tags as $t)
                                <li class="tag bg-success rounded-pill">    
                                    <a href="{{route('product.tag', ['tag_slug'=>$t->slug])}}">{{$t->name}}</a>
                                </li>    
                                @endforeach
                            </ul>
                            @if ($witems->contains($p->id))
                                <a href="javascript:void(0)" class="absolute top-0 right-0 mt-4 mr-4" wire:click.prevent="removeFromWishlist({{$p->id}})" wire:loading.attr="disabled"><i class="fa fa-heart fa-2x text-red-600"></i></a>    
                            @else
                                <a href="javascript:void(0)" class="absolute top-0 right-0 mt-4 mr-4" wire:click.prevent="addToWishlist({{$p->id}}, '{{$p->name}}', {{$p->price}})" wire:loading.attr="disabled"><i class="fa fa-heart fa-2x text-gray-200"></i></a>
                            @endif
                        </div>    
                        
                        <div class="product-text">
                            <span class="pro-price bg-dark">
                                <div class="tooltip-ex"><strong>{{$p->price}}$</strong><br>
                                    <span class="tooltip-ex-text tooltip-ex-top">@foreach ($dollar as $d){{number_format($d->price*$p->price, 2)}}@endforeach Bs.F</span>
                                </div>
                                    
                            </span>
                            <a class="text-gray-800" href="{{route('product.details',['slug'=>$p->slug])}}">
                                <h5 class="text-base font-bold mt-2 truncate">
                                    {{$p->name}} 
                                </h5>
                                <h5 class="text-base font-bold">
                                    ({{$p->presentation->name}} {{$p->presentation->medida}})
                                    @if ($p->stock == 0)
                                    <span class="text-sm text-red-500"> Sin stock</span>   
                                    @elseif($p->stock <= 10) 
                                    <span class="text-sm text-red-500"> Disponibilidad: {{ $p->stock }}</span>
                                    @endif
                                </h5>    
                            </a>
                        </div>
                    </div>
                    @if ($p->stock > 0)
                        <button type="button" wire:click.prevent="store({{$p->id}}, '{{$p->name}}', {{$p->price}})" wire:loading.attr="disabled" class="bg-red-500 text-white px-6 py-2 rounded font-medium mx-3 hover:bg-red-600 transition duration-200 each-in-out shadow-md">Agregar al Carrito <i class="ti-shopping-cart"></i></button>    
                    @else
                        <button class="bg-gray-150 text-gray-300 px-6 py-2 rounded font-medium mx-3 transition duration-200 each-in-out shadow-md">Agregar al Carrito <i class="ti-shopping-cart"></i></button>    
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @elseif (count($productss) == 0 & $search !== '')
    <div class="my-4 text-center">
        <h5 class="text-base text-gray-800">No hay Resultado para la Busqueda "{{$search}}"</h5>
    </div>
    @else
    <div class="my-4 text-center">
        <h5 class="text-base text-gray-800">No hay Productos en Stock</h5>
    </div>
    @endif
    <div class="px-4 py-3 justify-self-end sm:px-6">
                    
        {{$productss->links()}}

    </div>  
    
    @livewire('offer') 

    @if($business_partners->count() > 0)
    <h1 class="text-1xl font-bold text-center my-4">Aliados Comerciales</h1></div>
    <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-3 md:grid-cols-4 md:gap-4 lg:grid-cols-5 lg:gap-4 mx-2 p-4">
        
        @foreach ($business_partners as $bp)
        <div class="w-3/4 bg-white rounded-md shadow-md">
            <a href="{{$bp->link}}" target="_blank"><img loading="lazy" src="{{Storage::url($bp->img)}}" alt="{{$bp->name}}" title="{{$bp->name}}"></a>
        </div>    
        @endforeach    
        
    </div>
    @endif

    @push('css')
	    <link rel="stylesheet" type="text/css" href="{{ asset('dist/offer_slider/css/owl.carousel.min.css') }}">
	    <link rel="stylesheet" type="text/css" href="{{ asset('dist/offer_slider/css/styles.css') }}">
    @endpush
    @push('scripts')
        <script src="{{ asset('dist/offer_slider/js/jquery.flexslider.js') }}"></script>
        <script src="{{ asset('dist/offer_slider/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('dist/offer_slider/js/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('dist/offer_slider/js/jquery.sticky.js') }}"></script>
        <script src="{{ asset('dist/offer_slider/js/functions.js') }}"></script>
    @endpush
</div>
