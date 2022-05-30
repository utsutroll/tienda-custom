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

    <section id="hero">
        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with coupons & up to 70% off! </p>
        <button>Shop Now</button>
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

    <section id="product1" class="section-p1">
        <h2>Productos destacados</h2>

        @if (count($products) > 0)

        <div class="pro-container">
            @foreach ($products as $p)
            <div class="pro">
                @isset ($p->image->url)
                <a href="{{route('product.details',['slug'=>$p->slug])}}">
                    <img loading="lazy" src="{{Storage::url($p->image->url)}}" alt="{{$p->name}}">
                </a>
                @endisset
                <div class="des">
                    <span>{{ $p->brand->name }}</span>
                    <a href="{{route('product.details',['slug'=>$p->slug])}}"><h5>{{$p->name}}</h5></a>
                    <h4 data-tooltip-target="tooltip-top" data-tooltip-placement="top" class="text-center">{{ $p->price }}$</h4>
                    <div id="tooltip-top" role="tooltip" class="tooltip absolute z-10 inline-block bg-gray-900 font-medium shadow-sm text-white py-2 px-3 text-sm rounded-lg opacity-0 invisible" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(918px, 449px, 0px);">
                        @foreach ($dollar as $d){{ number_format($d->price*$p->price, 2) }}@endforeach Bs
                        <div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(54px, 0px, 0px);"></div>
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
    </section>

    <section id="banner" class="section-m1">
        <h4>Repair Services </h4>
        <h2>Up to <span>70% Off</span>  - All t-Shirts & Accessories</h2>
        <button class="normal">Explore More</button>
    </section>

    <section id="product1" class="section-p1">
        <h2>Nuevos productos</h2>

        @if (count($newproducts) > 0)

        <div class="pro-container">
            @foreach ($newproducts as $np)
            <div class="pro">
                @isset ($np->image->url)
                <a href="{{route('product.details',['slug'=>$np->slug])}}">
                    <img loading="lazy" src="{{Storage::url($np->image->url)}}" alt="{{$np->name}}">
                </a>
                @endisset
                <div class="des">
                    <span>{{ $np->brand->name }}</span>
                    <a href="{{route('product.details',['slug'=>$np->slug])}}"><h5>{{$np->name}}</h5></a>
                    <h4 data-tooltip-target="tooltip-top" data-tooltip-placement="top" class="text-center">{{ $np->price }}$</h4>
                    <div id="tooltip-top" role="tooltip" class="tooltip absolute z-10 inline-block bg-gray-900 font-medium shadow-sm text-white py-2 px-3 text-sm rounded-lg opacity-0 invisible" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(918px, 449px, 0px);">
                        @foreach ($dollar as $d){{ number_format($d->price*$np->price, 2) }}@endforeach Bs
                        <div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(54px, 0px, 0px);"></div>
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
    </section>

</div>

@push('scripts')
    <script>
        $('#LiHome').addClass("active");
    </script>
@endpush

