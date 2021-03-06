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
                    <img loading="lazy" class="img-responsive" src="{{Storage::url($s->image->url)}}" alt="{{$s->title}}">
                @else
                <a href="{{$s->link}}" target="_blank">
                    <img loading="lazy" class="img-responsive" src="{{Storage::url($s->image->url)}}" alt="{{$s->title}}">   
                </a> 
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

    <section class="w-full h-screen">
        <img src="{{ url('dist/new/img/banner.jpg') }}">
    </section>
    
    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="{{ url('dist/new/img/features/f1.png') }}" alt="">
            <h6>Envío gratuito</h6>
        </div>
    
        <div class="fe-box">
            <img src="{{ url('dist/new/img/features/f2.png') }}" alt="">
            <h6>Pedido en línea</h6>
        </div>
    
        <div class="fe-box">
            <img src="{{ url('dist/new/img/features/f3.png') }}" alt="">
            <h6>Ahorre dinero</h6>
        </div>
    
        <div class="fe-box">
            <img src="{{ url('dist/new/img/features/f4.png') }}" alt="">
            <h6>Promociones</h6>
        </div>
    
        <div class="fe-box">
            <img src="{{ url('dist/new/img/features/f5.png') }}" alt="">
            <h6>Venta segura</h6>
        </div>
    
        <div class="fe-box">
            <img src="{{ url('dist/new/img/features/f6.png') }}" alt="">
            <h6>Soporte 24/7</h6>
        </div>
    </section>

    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Productos Destacados</h2>
      
            @if (count($products) > 0)
            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($products as $p)
                <div class="group relative border border-green-200 rounded-tr-3xl rounded-3xl hover:shadow-lg shadow-black">
                    <div class="w-full min-h-80 bg-gray-200 rounded-t-3xl aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
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
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $p->product }}
                                </a>
                            </h3>
                        </div>
                        <p class="text-md mt-2 text-center font-semibold text-teal-600">{{ $p->price }}$</p>
                        <h6 class="text-xs text-center text-gray-600">~@foreach ($dollar as $d){{ number_format($d->price * $p->price, 2) }}@endforeach Bs</h6>
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


    <section id="banner" class="section-m1">
        <h4>Repair Services </h4>
        <h2>Up to <span>70% Off</span>  - All t-Shirts & Accessories</h2>
        <button class="normal">Explore More</button>
    </section>

    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl text-center font-extrabold tracking-tight text-gray-900">Nuevos productos</h2>
      
            @if (count($newproducts) > 0)
            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($newproducts as $np)
                <div class="group relative border border-green-200 rounded-tr-3xl rounded-3xl hover:shadow-lg shadow-black">
                    <div class="w-full min-h-80 bg-gray-200 rounded-t-3xl aspect-w-1 aspect-h-1 overflow-hidden lg:h-80 lg:aspect-none">
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
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $np->product }}
                                </a>
                            </h3>   
                        </div>
                        <p class="text-md mt-2 text-center font-semibold text-teal-600">{{ $np->price }}$</p>
                        <h6 class="text-xs text-center text-gray-600">~@foreach ($dollar as $d){{ number_format($d->price * $np->price, 2) }}@endforeach Bs</h6>
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
</div>

@push('scripts')
    <script>
        $('#LiHome').addClass("active");
    </script>
@endpush

