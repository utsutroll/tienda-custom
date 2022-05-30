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

    <div class="p-3 mb-3 bg-gray-100">
        <div class="grid grid-cols-8 gap-4">
            <div class="col-start-4 col-span-2 flex outline-none">
                <input type="search" id="search_box" wire:model="search" class="border-t-0 border-x-0 border-solid border-b-2 focus:outline-none" placeholder="Buscar &hellip;" />
                @if ($search !== '')
                    <button class="btn btn-outline-secondary border-0 btn-sm waves-effect waves-light" wire:click="$set('search', '')" type="button"><span class="btn-label"><i class="fa fa-times"></i></span></button>    
                @endif
               
                <div class="ml-1 mt-1">
                    <button class="btn btn-outline-secondary border-0" type="button" wire:click="$set('buscar', 1)"><i class="fa fa-search text-xl"></i></button>
                </div>
            </div> 
        </div>            
    </div>

    <section id="product1" class="section-p1">
        <h2>Productos destacados</h2>

        @if (count($products) > 0)

        <div class="pro-container">
            @foreach ($products as $p)
            <div class="pro">
                @isset ($p->image->url)
                <a href="{{ route('product.details',['slug'=>$p->slug]) }}">
                    <img loading="lazy" src="{{ Storage::url($p->image->url) }}" alt="{{ $p->name }}">
                </a>    
                @endisset
                <div class="des">
                    <span>{{ $p->brand->name }}</span>
                    <a href="{{ route('product.details',['slug'=>$p->slug]) }}"><h5>{{ $p->name }}</h5></a>
                    <h4 data-tooltip-target="tooltip-top" data-tooltip-placement="top" class="text-center">{{ $p->price }}$</h4>
                    <div id="tooltip-top" role="tooltip" class="tooltip absolute z-10 inline-block bg-gray-900 font-medium shadow-sm text-white py-2 px-3 text-sm rounded-lg opacity-0 invisible" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(918px, 449px, 0px);">
                        @foreach ($dollar as $d){{ number_format($d->price*$p->price, 2) }}@endforeach Bs
                        <div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(54px, 0px, 0px);"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @elseif (count($products) == 0 & $search !== '')
        <div class="my-4 text-center">
            <h5 class="text-base text-gray-800">No hay Resultado para la Busqueda "{{$search}}"</h5>
        </div>
        @else
        <div class="my-4 text-center">
            <h5 class="text-base text-gray-800">No hay Productos en Stock</h5>
        </div>
        @endif
        <div class="px-4 py-3 justify-self-end sm:px-6">
                        
            {{$products->links()}}

        </div>
    </section>
    
    {{-- @livewire('offer') --}}

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

        <script>
            $('#LiShop').addClass("active");
        </script>
    @endpush
</div>
