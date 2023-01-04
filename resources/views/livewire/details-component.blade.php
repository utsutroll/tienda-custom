<div>
    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
            <div class="shadow-md shadow-black mb-4">
                <img src="{{ Storage::url($product->image->url) }}" width="100%" id="MainImg" />
            </div>
            
            <div class="grid grid-cols-4 gap-4">
                @foreach ($product->characteristics_product as $pro_char_img)
                <div class="small-img-col shadow-md shadow-black">
                    <img src="{{ Storage::url($pro_char_img->image) }}" width="100%" class="small-img" onclick="myFunction(this)" />
                </div>
                @endforeach
            </div>
        </div>    
        @php
            $witems = Cart::instance('wishlist')->content()->pluck('id');
        @endphp

        <div class="single-pro-details">
            @if(Route::has('login'))
                @auth
                    @if ($witems->contains($product->id))
                        <span class="flex justify-start text-2xl"><i class="fa fa-heart text-red-600"></i></span>
                    @endif
                @endauth    
            @endif
            <h4 class="text-2xl text-black font-semibold">{{ $product->name }} {{ $product->brand->name }}</h4>
            <h2>@foreach ($this->dollar as $d){{ $d->price*$product->price }} @endforeach Bs</h2> 

            <form wire:submit.prevent="store" class="mt-8">
                <select wire:model.defer="id_product" class="bg-gray-100 border border-gray-500 p-3 w-36 text-gray-900 text-sm focus:ring-gray-500 focus:border-gray-500 max-w-18 max-h-16" title="Debe Seleccionar una Opción" required="required">
                    <option value="0">Seleccione</option>
                    @foreach ( $product->characteristics_product as $pro_char )
                        @if ($pro_char->stock > 0 && $pro_char->price > 0 || $pro_char->sale_price > 0)
                            <option value="{{ $pro_char->id }}">{{ $pro_char->characteristic->name }}  @if ($pro_char->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now()) @foreach ($this->dollar as $d){{ $d->price*$pro_char->sale_price }} @endforeach Bs @else @foreach ($this->dollar as $d){{ $d->price*$pro_char->price }} @endforeach Bs @endif</option>
                        @endif
                    @endforeach
                </select>
                @error('id_product')
                    <small class="text-sm text-red-600">{{$message}}</small>   
                @enderror
            
                @if ($product->stock > 0)
                <div class="flex items-center">
                    <div class="flex flex-row border-0 h-10 w-32 rounded-lg border-gray-400 relative my-4 mr-4">
                        <button wire:click.prevent="decreaseQuantityD" class="font-semibold border border-gray-500 w-10 h-12 bg-gray-100 hover:bg-emerald-700 hover:text-white flex focus:outline-none cursor-pointer">
                            <span class="m-auto">-</span>
                        </button>
                        <input type="text" type="text" wire:model.defer="qty" disabled data-max="120" pattern="[0-9]" class="md:p-2 p-1 w-12 h-12 text-xs md:text-base border-t border-b border-r-0 border-l-0 border-gray-500 focus:outline-none text-center"/>

                        <button wire:click.prevent="increaseQuantityD" class="font-semibold border border-gray-500 w-10 h-12 bg-gray-100 hover:bg-emerald-700 hover:text-white flex focus:outline-none cursor-pointer">
                            <span class="m-auto">+</span>
                        </button>
                    </div> 
                    <button class="border border-gray-500 p-2.5 mt-2 text-black hover:text-white font-semibold bg-gray-50 hover:bg-emerald-700" type="submit" wire:loading.attr="disabled" title="Añadir al carrito">Agregar al carrito <button>    
                </div>
                @endif
                 
            </form> 

            <h4 class="text-2xl text-black font-semibold">Detalles del Producto</h4>
            <span>{{ $product->details }}</span>
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
                                <span aria-hidden="true" class="absolute"></span>
                                {{ $s->product }}
                            </a>
                        </h3>   
                    </div>
                    <div class="flex justify-between">
                        <p class="text-md mt-2 text-center font-semibold text-teal-600">@foreach ($this->dollar as $d){{ number_format($d->price * $s->price, 2) }}@endforeach Bs</p>
                        @if(Route::has('login'))
                            @auth   
                                @if ($witems->contains($s->id))
                                    <div class="mt-1"><a href="javascript:void(0)" wire:click.prevent="removeFromWishlist({{$s->id}})" wire:loading.attr="disabled"><i class="fa fa-heart text-red-600"></i></a></div>
                                @else
                                    <div class="mt-1"><a href="javascript:void(0)"><i class="text-teal-600 far fa-heart" wire:click.prevent="addToWishlist({{$s->id}}, '{{$s->product}}', {{$s->price}})" wire:loading.attr="disabled"></i></a></div>
                                @endif
                            @endauth    
                        @endif       
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

@push('scripts')
    <script>
        $( document ).ready(function() {
            var fullImgs = document.getElementById("MainImg");
            var temp = fullImgs.src
            $('#MainImg').click(function(){
                fullImgs.src=temp;
            })
        });

        function myFunction(smallImg) {
            var fullImg = document.getElementById("MainImg");
            fullImg.src=smallImg.src;

        }
        
    @if (session()->has('info'))    
        Swal.fire({
            icon: 'success',
            text: '{{ session('info') }}'
        }); 
    @endif
    </script>
@endpush