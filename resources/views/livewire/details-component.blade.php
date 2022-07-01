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
            <h4 class="text-2xl text-black font-semibold">{{ $product->name }} {{ $product->brand->name }}</h4>
            <h2>{{ $product->price }}$</h2> 
            <h4 class="text-lg text-black font-semibold">Detalles del Producto</h4>
            <span>{{ $product->details }}</span>
         
            <form wire:submit.prevent="store" class="mt-8">
                <ul class="block">
                    @foreach ($product->characteristics_product as $pro_char)
                        @if ($pro_char->stock > 0)

                            <li class="inline-block mb-2">
                                <div class="p-4 mr-2 border-2 border-solid rounded-lg">
                                    <input type="radio" class="w-4 h-4" wire:model.defer="id_product" name="id_product" value="{{ $pro_char->id }}">
                                    <span class="font-bold">{{ $pro_char->characteristic->name }}</span>
                                    @if ($pro_char->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                        <span class="font-bold ml-4 font-sans">{{ $pro_char->sale_price }} $</span>
                                        <del><span class="text-sm text-gray-600 font-sans">{{ $pro_char->price }} $</span></del>
                                    @else
                                        <span class="font-bold ml-4 inline-block font-sans">{{ $pro_char->price }} $</span>
                                    @endif    
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            
                @if ($product->stock > 0)
                <div class="flex flex-row border h-10 w-24 rounded-lg border-gray-400 relative my-3">
                    <button wire:click.prevent="decreaseQuantityD" class="font-semibold border-r w-7 bg-gray-200 hover:bg-red-600 hover:text-white border-gray-400 flex rounded-l focus:outline-none cursor-pointer">
                        <span class="m-auto">-</span>
                    </button>
                    <input type="text" type="text" wire:model.defer="qty" disabled data-max="120" pattern="[0-9]" class="md:p-2 p-1 w-11 text-xs md:text-base border-gray-300 focus:outline-none text-center"/>

                    <button wire:click.prevent="increaseQuantityD" class="font-semibold border-l w-7 bg-gray-200 hover:bg-red-600 hover:text-white border-gray-400 flex rounded-r focus:outline-none cursor-pointer">
                        <span class="m-auto">+</span>
                    </button>
                </div> 
                <button class="rounded-lg p-4" type="submit" wire:loading.attr="disabled" title="Añadir al carrito"><i class="fas fa-cart-plus"></i> <button>    
                @endif
                 
            </form> 
        </div>
    </section>
    
    <section id="product1" class="section-p1 mb-4">
        <h2 class="text-2xl text-black font-bold font-sans">Productos Similares</h2>

        @if (count($similares) > 0)
        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @foreach ($similares as $s)
            <div class="group relative border border-green-200 rounded-tr-3xl rounded-3xl hover:shadow-lg shadow-black">
                <div class="w-full min-h-80 bg-gray-200 rounded-t-3xl aspect-w-1 aspect-h-1 overflow-hidden lg:h-80 lg:aspect-none">
                    @isset ($s->imagen)
                    <a href="{{route('product.details',['slug'=>$s->slug])}}">
                        <img loading="lazy" src="{{Storage::url($s->imagen)}}" alt="{{$s->product}}" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                    </a>
                    @endisset
                </div>
                <div class="py-4 px-4 flex-row">
                    <div>
                        <p class="my-2 text-sm text-gray-500">{{ $s->brand }}</p>
                        <h3 class="text-sm font-medium text-gray-900">
                            <a href="{{route('product.details',['slug'=>$s->slug])}}">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $s->product }}
                            </a>
                        </h3>   
                    </div>
                    <p class="text-md mt-2 text-center font-semibold text-teal-600">{{ $s->price }}$</p>
                    <h6 class="text-xs text-center text-gray-600">~@foreach ($dollar as $d){{ number_format($d->price * $s->price, 2) }}@endforeach Bs</h6>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <h1 class="text-base text-gray-500 mt-4">No se encontrarón productos similares.</h1>
        @endif
    </section>
</div>

@push('scripts')
    <script>
        document.getElementsByClassName('small-img').onclick = function() {
            document.getElementById('MainImg').src = document.getElementsByClassName('small-img').src;
        }
    </script>
@endpush