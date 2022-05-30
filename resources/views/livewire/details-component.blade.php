<div>
    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
            <img src="{{ Storage::url($product->image->url) }}" width="100%" id="MainImg" />
            
            <div class="small-img-group">
                @foreach ($product->characteristics_product as $pro_char_img)
                <div class="small-img-col">
                    <img src="{{Storage::url($pro_char_img->image)}}" width="100%" class="small-img"  />
                </div>
                @endforeach
            </div>
        </div>    
        
        <div class="single-pro-details">
            <h4>{{ $product->name }} {{ $product->brand->name }}</h4>
            <h2>{{ $product->price }}$</h2> 
            <h4>Detalles del Producto</h4>
            <span>{{ $product->details }}</span>
         
            <form wire:submit.prevent="store" class="mt-8">
                <ul class="block">
                    @foreach ($product->characteristics_product as $pro_char)
                        @if ($pro_char->stock > 0)
                            <li class="inline-block">
                                <div class="p-2 mr-2 border-2 border-solid rounded-lg">
                                    <input type="radio" class="w-4 h-4" wire:model.defer="id_product" name="id_product" value="{{ $pro_char->id }}">
                                    <span class="font-bold">{{ $pro_char->characteristic->name }}</span>
                                    <span class="font-bold ml-4 inline-block">{{ $pro_char->price }} $</span>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            
                <div class="flex flex-row border h-10 w-24 rounded-lg border-gray-400 relative my-3">
                    <button wire:click.prevent="decreaseQuantityD" class="font-semibold border-r w-7 bg-gray-200 hover:bg-red-600 hover:text-white border-gray-400 flex rounded-l focus:outline-none cursor-pointer">
                        <span class="m-auto">-</span>
                    </button>
                    <input type="text" type="text" wire:model.defer="qty" disabled data-max="120" pattern="[0-9]" class="md:p-2 p-1 w-11 text-xs md:text-base border-gray-300 focus:outline-none text-center"/>

                    <button wire:click.prevent="increaseQuantityD" class="font-semibold border-l w-7 bg-gray-200 hover:bg-red-600 hover:text-white border-gray-400 flex rounded-r focus:outline-none cursor-pointer">
                        <span class="m-auto">+</span>
                    </button>
                </div> 
                <button class="rounded-lg p-4" type="submit" wire:loading.attr="disabled" data-toggle="tooltip" title="" data-original-title="Añadir al carrito"><i class="fas fa-cart-plus"></i> <button>
                {{-- @if ($product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                <button class="btn btn-dark btn-rounded m-r-5" wire:click.prevent="store({{$product->id}}, '{{$product->name}}', {{$product->sale_price}})" wire:loading.attr="disabled" data-toggle="tooltip" title="" data-original-title="Añadir al carrito"><i class="ti-shopping-cart"></i> <button>  
                @else
                <button class="btn btn-dark btn-rounded m-r-5" wire:click.prevent="store({{$product->id}}, '{{$product->name}}', {{$product->price}})" wire:loading.attr="disabled" data-toggle="tooltip" title="" data-original-title="Añadir al carrito"><i class="ti-shopping-cart"></i> <button>  
                @endif  --}}   
            </form> 
        </div>
    </section>
    
    <section id="product1" class="section-p1">
        <h2>Productos Similares</h2>

        @if (count($similares) > 0)
        <div class="pro-container">
            
            @foreach ($similares as $s)
            <div class="pro">
                <a class="flex space-y-2 p-2" href="{{route('product.details',['slug'=>$s->slug])}}">
                    <img src="{{Storage::url($s->image->url)}}" alt="{{$s->name}}">
                </a>    
                <div class="des">
                    <a class="flex space-y-2 p-2" href="{{route('product.details',['slug'=>$s->slug])}}"><span>{{ $s->brand->name }}</span></a> 
                    <h5>{{ $s->name }}</h5>
                    <h4 data-tooltip-target="tooltip-top" data-tooltip-placement="top" class="text-center">{{ $s->price }}$</h4>
                    <div id="tooltip-top" role="tooltip" class="tooltip absolute z-10 inline-block bg-gray-900 font-medium shadow-sm text-white py-2 px-3 text-sm rounded-lg opacity-0 invisible" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(918px, 449px, 0px);">
                        @foreach ($dollar as $d){{ number_format($d->price*$s->price, 2) }}@endforeach Bs
                        <div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(54px, 0px, 0px);"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <h1 class="text-base text-gray-500 mt-4">No se encontrarón productos similares.</h1>
        @endif
    </section>
</div>