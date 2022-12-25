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
    @if($sproducts->count() > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
    <div class="mb-2 pl-2 py-2 border-y-2 border-gray-700 bg-gray-200 wrap-countdown mercado-countdown" data-expire="{{ Carbon\Carbon::parse($sale->sale_date)->format('Y/m/d h:m:s') }}"></div>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            @if (count($sproducts) > 0)
            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($sproducts as $sp)
                <div class="group relative border border-green-200 rounded-tr-3xl rounded-3xl hover:shadow-lg shadow-black">
                    <div class="w-full min-h-80 bg-gray-200 rounded-t-3xl aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        @isset ($sp->image)
                        <a href="{{route('product.details',['slug'=>$sp->product->slug])}}">
                            <figure><img src="{{ Storage::url($sp->image) }}" width="800" height="800"></figure>
                        </a>
                        @endisset
                    </div>
                    <div class="py-4 px-4 flex-row">
                        <div>
                            {{-- <p class="my-2 text-sm text-gray-500">{{ $sp->brand->name }}</p> --}}
                            <h3 class="text-sm font-medium text-gray-900 text-center">
                                <a href="{{ route('product.details',['slug'=>$sp->product->slug]) }}" class="product-name"><span>{{ $sp->product->name }} {{ $sp->product->brand->name }} {{ $sp->characteristic->name }}</span></a>
                                <div class="wrap-price"><ins><p class="text-md mt-2 text-center font-semibold text-teal-600">@foreach ($dollar as $d){{ $d->price*$sp->sale_price }} @endforeach Bs</p></ins> <del><p class="text-sm text-gray-500">@foreach ($dollar as $d){{ $d->price*$sp->price }} @endforeach Bs</p></del></div>
                            </h3>
                        </div>
                        
                        {{-- <div class="flex justify-between">
                            <p class="text-md mt-2 text-center font-semibold text-teal-600">@foreach ($dollar as $d){{ number_format($d->price * $sp->price, 2) }}@endforeach Bs</p>
                            {{-- @if ($witems->contains($p->id))
                                <div class="mt-1"><a href="javascript:void(0)" wire:click.prevent="removeFromWishlist({{$p->id}})" wire:loading.attr="disabled"><i class="fa fa-heart text-red-600"></i></a></div>
                            @else
                                <div class="mt-1"><a href="javascript:void(0)"><i class="text-teal-600 far fa-heart" wire:click.prevent="addToWishlist({{$p->id}}, '{{$p->product}}', {{$p->price}})" wire:loading.attr="disabled"></i></a></div>
                            @endif    
                        </div> --}}
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

    @else
    <div class="my-4 text-center font-semibold p-24">
        <h5 class="text-base text-gray-800">No hay Productos en Oferta</h5>
    </div>               
    @endif
</div>
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
        $('#LiOffer').addClass("active");
    </script>

@endpush

