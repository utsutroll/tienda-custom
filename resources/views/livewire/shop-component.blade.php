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

    <div class="p-3 mb-3 bg-slate-100 shadow-md shadow-black">
        <div class="flex flex-row justify-center">
            <input type="search" id="search_box" wire:model="search" class="border-t-0 border-l-0 border-r-0 border-b-2 focus:outline-none focus:ring-0" placeholder="Buscar &hellip;" />
            @if ($search !== '')
                <button class="btn btn-outline-secondary border-0 btn-sm waves-effect waves-light" wire:click="$set('search', '')" type="button"><span class="btn-label"><i class="fa fa-times"></i></span></button>    
            @endif
           
            <div class="ml-1 mt-1">
                <button class="btn btn-outline-secondary border-0" type="button" wire:click="$set('buscar', 1)"><i class="fa fa-search text-xl"></i></button>
            </div>
        </div>           
    </div>
    
    @php
        $witems = Cart::instance('wishlist')->content()->pluck('id');
    @endphp

    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            @if (count($products) > 0)
            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($products as $p)
                <div class="group relative border border-green-200 rounded-tr-3xl rounded-3xl hover:shadow-lg shadow-black">
                    <div class="w-full min-h-80 bg-gray-200 rounded-t-3xl aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        @isset ($p->image->url)
                        <a href="{{route('product.details',['slug'=>$p->slug])}}">
                            <img loading="lazy" src="{{Storage::url($p->image->url)}}" alt="{{$p->name}}" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                        </a>
                        @endisset
                    </div>
                    <div class="py-4 px-4 flex-row">
                        <div>
                            <p class="my-2 text-sm text-gray-500">{{ $p->brand->name }}</p>
                            <h3 class="text-sm font-medium text-gray-900">
                                <a href="{{route('product.details',['slug'=>$p->slug])}}">
                                    <span aria-hidden="true" class="absolute"></span>
                                    {{ $p->name }}
                                </a>
                            </h3>
                        </div>
                        
                        <div class="flex justify-between">
                            <p class="text-md mt-2 text-center font-semibold text-teal-600">@foreach ($dollar as $d){{ number_format($d->price * $p->price, 2) }}@endforeach Bs</p>
                            @if(Route::has('login'))
                                @auth
                                    @if ($witems->contains($p->id))
                                        <div class="mt-1"><a href="#" wire:click.prevent="removeFromWishlist({{$p->id}})"><i class="fa fa-heart text-red-600"></i></a></div>
                                    @else
                                        <div class="mt-1"><a href="javascript:void(0)" wire:click.prevent="addToWishlist({{$p->id}}, '{{$p->name}}', {{$p->price}})"><i class="text-teal-600 far fa-heart"></i></a></div>
                                    @endif
                                @endauth    
                            @endif            
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
        </div>
    </div>

    
    @push('scripts')
        <script>
            $('#LiShop').addClass("active");
        </script>
    @endpush
</div>
