@if($sproducts->count() > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now() )
<main id="main">
    <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="border rounded-lg">
            <h3 class="py-4 bg-teal-400 rounded-t-lg text-3xl text-white text-center font-sans font-semibold">Ofertas</h3>
            <div class="mb-2 pl-2 py-2 border-y-2 border-gray-700 bg-gray-200 wrap-countdown mercado-countdown" data-expire="{{ Carbon\Carbon::parse($sale->sale_date)->format('Y/m/d h:m:s') }}"></div>
            <div class="mx-2 mb-2 wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                @foreach ($sproducts as $sp)
                <div class="group relative border mr-2 border-green-200 rounded-tr-3xl rounded-3xl hover:shadow-lg shadow-black">
                    <div class="w-full min-h-80 rounded-t-3xl overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        <a href="{{ route('product.details',['slug'=>$sp->product->slug]) }}">
                            @isset($sp->image)
                            <figure><img src="{{ Storage::url($sp->image) }}" width="800" height="800"></figure>
                            @endisset 
                        </a>
                    </div>
                    <div class="product-info text-center">
                        <a href="{{ route('product.details',['slug'=>$sp->product->slug]) }}" class="product-name"><span>{{ $sp->product->name }} {{ $sp->product->brand->name }} {{ $sp->characteristic->name }}</span></a>
                        <div class="wrap-price"><ins><p class="text-md mt-2 text-center font-semibold text-teal-600">@foreach ($dollar as $d){{ $d->price*$sp->sale_price }} @endforeach Bs</p></ins> <del><p class="text-sm text-gray-500">@foreach ($dollar as $d){{ $d->price*$sp->price }} @endforeach Bs</p></del></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div> 
    </div>
</main>  
@else
<div></div>                
@endif


