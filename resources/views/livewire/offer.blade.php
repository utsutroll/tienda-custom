@if($sproducts->count() > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now() )
<main id="main">
    <div class="w-full p-2 ">
        <div class="wrap-show-advance-info-box style-1 has-countdown shadow-md bg-white">
            <h3 class="title-box">Ofertas</h3>
            <div class="wrap-countdown mercado-countdown" data-expire="{{ Carbon\Carbon::parse($sale->sale_date)->format('Y/m/d h:m:s') }}"></div>
            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                @foreach ($sproducts as $sp)
                <div class="product product-style-2 equal-elem">
                    <div class="product-thumnail">
                        <a href="{{route('product.details',['slug'=>$sp->slug])}}" title="{{$sp->name}}">
                            <figure><img src="{{Storage::url($sp->image->url)}}" alt="{{$sp->name}}" width="800" height="800"></figure>
                        </a>
                        <div class="group-flash">
                            <span class="flash-item sale-label">Oferta</span>
                        </div>
                    </div>
                    <div class="product-info">
                        <a href="{{route('product.details',['slug'=>$sp->slug])}}" class="product-name"><span>{{$sp->name}}</span></a>
                        <div class="wrap-price"><ins><p class="product-price">{{ $sp->sale_price }}$</p></ins> <del><p class="product-price">{{ $sp->price }}</p></del></div>
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


