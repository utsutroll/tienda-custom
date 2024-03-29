<div class="bg-white">
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
                    <img loading="lazy" class="img-responsive" src="{{Storage::url($s->image->url)}}" alt="{{$s->title}}">
                @else
                <a href="{{$s->link}}" target="_blank">
                    <img loading="lazy" class="img-responsive" src="{{Storage::url($s->image->url)}}" alt="{{$s->title}}">   
                </a> 
                @endif
                
                <div class="carousel-caption d-none d-md-block">
                    <h3 style="font-size:2vw;">{{$s->title}}</h3>
                    <p class="m-auto text-gray-200" style="font-size:1vw;">{{$s->subtitle}}</p>
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

    @php
        $witems = Cart::instance('wishlist')->content()->pluck('id');
    @endphp
    
    <div class="bg-white">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Productos Destacados</h2>
      
            @if (count($products) > 0)
            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($products as $p)
                <div class="group relative border border-green-200 rounded-tr-3xl rounded-3xl hover:shadow-lg shadow-black">
                    <div class="relative w-full min-h-80 bg-gray-200 rounded-t-3xl aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        <div class="absolute bottom-0 left-0 w-16 marca-de-agua">
                            <img src="{{ asset('dist/new/img/logos/marca-de-agua.png') }}">
                        </div>
                        @isset ($p->imagen)
                        <a href="{{route('product.details',['slug'=>$p->slug])}}">
                            <img loading="lazy" src="{{Storage::url($p->imagen)}}" alt="{{$p->product}}" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                        </a>
                        @endisset
                    </div>
                    <div class="py-4 px-4 flex-row">
                        <div>
                            <p class="my-2 text-sm text-gray-500">{{ $p->brand }}</p>
                            <h3 class="text-sm font-medium text-gray-900">
                                <a href="{{route('product.details',['slug'=>$p->slug])}}">
                                    <span aria-hidden="true" class="absolute"></span>
                                    {{ $p->product }}
                                </a>
                            </h3>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-md mt-2 text-center font-bold text-blue-600">@foreach ($dollar as $d){{ number_format($d->price * $p->price, 2) }}@endforeach Bs</p>
                            @if(Route::has('login'))
                                @auth 
                                    @if ($witems->contains($p->id))
                                        <div class="mt-1"><a href="javascript:void(0)" wire:click.prevent="removeFromWishlist({{ $p->id }})"><i class="fa fa-heart text-red-600"></i></a></div>
                                    @else
                                        <div class="mt-1"><a href="javascript:void(0)" wire:click.prevent="addToWishlist({{ $p->id }}, '{{ $p->product }}', {{ $p->price }}, '{{ $p->imagen }}', '{{ $p->brand }}', '{{ $p->slug }}')"><i class="text-teal-600 far fa-heart"></i></a></div>
                                    @endif
                                @endauth    
                            @endif            
                        </div>
                        
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <div class="my-4 text-center">
                    <h5 class="text-base text-gray-800">No hay Productos en Stock</h5>
                </div>
            @endif
        </div>
    </div>

    <section class="w-full">
        <img src="{{ url('dist/new/img/banner2meka-final.jpg') }}">
    </section>

    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl text-center font-extrabold tracking-tight text-gray-900">Nuevos productos</h2>
      
            @if (count($newproducts) > 0)
            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($newproducts as $np)
                <div class="group relative border border-green-200 rounded-tr-3xl rounded-3xl hover:shadow-lg shadow-black">
                    <div class="relative w-full min-h-80 bg-gray-200 rounded-t-3xl aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        <div class="absolute bottom-0 left-0 w-16 marca-de-agua">
                            <img src="{{ asset('dist/new/img/logos/marca-de-agua.png') }}">
                        </div>
                        @isset ($np->imagen)
                        <a href="{{route('product.details',['slug'=>$np->slug])}}">
                            <img loading="lazy" src="{{Storage::url($np->imagen)}}" alt="{{$np->product}}" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                        </a>
                        @endisset
                    </div>
                    <div class="py-4 px-4 flex-row">
                        <div>
                            <p class="my-2 text-sm text-gray-500">{{ $np->brand }}</p>
                            <h3 class="text-sm font-medium text-gray-900">
                                <a href="{{route('product.details',['slug'=>$np->slug])}}">
                                    <span aria-hidden="true" class="absolute"></span>
                                    {{ $np->product }}
                                </a>
                            </h3>   
                        </div>
                        <div class="flex justify-between">
                            <p class="text-md mt-2 text-center font-bold text-blue-600">@foreach ($dollar as $d){{ number_format($d->price * $np->price, 2) }}@endforeach Bs</p>
                            @if(Route::has('login'))
                                @auth 
                                    @if ($witems->contains($np->id))
                                        <div class="mt-1"><a href="javascript:void(0)" wire:click.prevent="removeFromWishlist({{$np->id}})" wire:loading.attr="disabled"><i class="fa fa-heart text-red-600"></i></a></div>
                                    @else
                                        <div class="mt-1"><a href="javascript:void(0)"><i class="text-teal-600 far fa-heart" wire:click.prevent="addToWishlist({{$np->id}}, '{{$np->product}}', {{$np->price}}, '{{ $np->imagen }}', '{{ $np->brand }}', '{{ $np->slug }}'))"></i></a></div>
                                    @endif
                                @endauth    
                            @endif 
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <div class="my-4 text-center">
                    <h5 class="text-base text-gray-800">No hay Productos en Stock</h5>
                </div>
            @endif
        </div>
    </div>

    @if($business_partners->count() > 0)
    <div class="bg-white">
        <h2 class="text-2xl font-extrabold tracking-tight text-center text-gray-900 mt-8">Aliados Comerciales</h2>

        <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-3 md:grid-cols-4 md:gap-4 lg:grid-cols-5 lg:gap-4 mx-2 p-4">

            @foreach ($business_partners as $bp)
            <div class="w-3/4 bg-white rounded-md shadow-md">
                <a href="{{$bp->link}}" target="_blank"><img loading="lazy" src="{{Storage::url($bp->img)}}" alt="{{$bp->name}}"
                        title="{{$bp->name}}"></a>
            </div>
            @endforeach

        </div>
    </div>    
    @endif

</div>

@push('scripts')
    <script>
        $('#LiHome').addClass("active");
    </script>
@endpush

