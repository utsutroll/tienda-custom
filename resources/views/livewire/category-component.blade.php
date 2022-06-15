<div>
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @for ($i = 0; $i < count($sliders); $i++) <li data-target="#carousel" data-slide-to="{{$i}}" @if ($i==0)
                class="active" @endif>
                </li>
                @endfor
        </ol>

        <div class="carousel-inner" role="listbox">
            @php $n=0 @endphp
            @foreach ($sliders as $s)
            <div @if ($n==0) class="carousel-item active" @else class="carousel-item" @endif>
                @if ($s->link == '')
                <img loading="lazy" class="img-responsive" src="{{Storage::url($s->image->url)}}" alt="{{$s->title}}">
                @else
                <a href="{{$s->link}}" target="_blank">
                    <img loading="lazy" class="img-responsive" src="{{Storage::url($s->image->url)}}"
                        alt="{{$s->title}}">
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

    {{-- <div class="p-3 mb-3 bg-slate-100 shadow-md shadow-black">
        <div class="flex flex-row justify-center">
            <input type="search" id="search_box" wire:model="search"
                class="border-t-0 border-l-0 border-r-0 border-b-2 focus:outline-none focus:ring-0"
                placeholder="Buscar &hellip;" />
            @if ($search !== '')
            <button class="btn btn-outline-secondary border-0 btn-sm waves-effect waves-light"
                wire:click="$set('search', '')" type="button"><span class="btn-label"><i
                        class="fa fa-times"></i></span></button>
            @endif

            <div class="ml-1 mt-1">
                <button class="btn btn-outline-secondary border-0" type="button" wire:click="$set('buscar', 1)"><i
                        class="fa fa-search text-xl"></i></button>
            </div>
        </div>
    </div> --}}


    <div class="w-full p-6 my-6 flex justify-between border-b-2">
        <h1 class="text-4xl font-bold font-sans">Categorías</h1>
        <div>
            <button type="button" wire:click="refresh()" title="Todos" class="mr-2 p-2 sm:ml-6 text-gray-400 hover:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                    <path d="M9 21h12V3H3v18h6zm10-4v2h-6v-6h6v4zM15 5h4v6h-6V5h2zM5 7V5h6v6H5V7zm0 12v-6h6v6H5z"></path>
                </svg>
                <span class="sr-only">Todos</span>
            </button>

            <button type="button" id="filter" title="Filtrar" class="p-2 sm:ml-6 text-gray-400 hover:text-gray-500">
                <span class="sr-only">Filters</span>
                <!-- Heroicon name: solid/filter -->
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
    

    <div class="col-span-1 hidden" id="categories">
        <aside class="w-64 md:w-72 lg:w-80 h-full md:mt-6 lg:mt-12 fixed inset-y-10 left-0 z-40 bg-white border-r-2" aria-label="Sidebar">
            <div class="relative overflow-y-auto py-4 px-3 bg-slate-100 divide-y divide-gray-300">
                <div class="px-4 flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">Categorías</h2>
                    <button type="button" id="close-menu"
                        class="-mr-2 w-10 h-10 bg-white p-2 rounded-md flex items-center justify-center text-gray-400">
                        <span class="sr-only">Close menu</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <ul class="space-y-2 divide-y divide-gray-300">
                    @foreach ($this->categories as $category)
                    <li>
                        <button type="button"
                            class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 accordion-titulo">
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>{{
                                $category->name }}</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="accordion-content" class="hidden py-2 space-y-2">
                            @foreach ($category->subCategory as $subcategory)
                            <li>
                                <div
                                    class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <input type="checkbox" class="rounded-sm mr-2" id="filtro"
                                        wire:model="filter.subcategory.{{ $subcategory->id }}">
                                    <label for="filtro">{{ $subcategory->name }}</label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>

    <div class="lg:py-20 px-6 pb-6">
        @if (count($this->results) > 0)
        <div class="grid grid-cols-1 gap-y-10 gap-x-6 md:gap-y-5 md:gap-x-3 lg:gap-y-5 lg:gap-x-3 md:grid-cols-5 lg:grid-cols-5 xl:gap-x-8">
            @foreach ($this->results as $p)
            <div class="group relative border border-green-200 rounded-tr-3xl rounded-3xl hover:shadow-lg shadow-black">
                <div class="w-full min-h-80 bg-gray-200 rounded-t-3xl aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                    @isset ($p->image->url)
                    <a href="{{route('product.details',['slug'=>$p->slug])}}">
                        <img loading="lazy" src="{{Storage::url($p->image->url)}}" alt="{{$p->name}}"
                            class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                    </a>
                    @endisset
                </div>
                <div class="py-4 px-4 flex-row">
                    <div>
                        <p class="my-2 text-sm text-gray-500">{{ $p->brand->name }}</p>
                        <h3 class="text-sm font-medium text-gray-900">
                            <a href="{{route('product.details',['slug'=>$p->slug])}}">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $p->name }}
                            </a>
                        </h3>
                    </div>
                    <p class="text-md mt-2 text-center font-semibold text-teal-600">{{ $p->price }}$</p>
                    <h6 class="text-xs text-center text-gray-600">~@foreach ($dollar as $d){{
                        number_format($d->price * $p->price, 2) }}@endforeach Bs</h6>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="my-4 text-center">
            <h5 class="text-base text-gray-800">No hay Productos en Stock</h5>
        </div>
        @endif
        <div class="px-4 py-3 justify-self-end sm:px-6">
            {{ $this->results->links() }}
        </div>
    </div>



    @livewire('offer')

    @if($business_partners->count() > 0)
    <h1 class="text-1xl font-bold text-center my-4">Aliados Comerciales</h1>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-3 md:grid-cols-4 md:gap-4 lg:grid-cols-5 lg:gap-4 mx-2 p-4">

    @foreach ($business_partners as $bp)
    <div class="w-3/4 bg-white rounded-md shadow-md">
        <a href="{{$bp->link}}" target="_blank"><img loading="lazy" src="{{Storage::url($bp->img)}}" alt="{{$bp->name}}"
                title="{{$bp->name}}"></a>
    </div>
    @endforeach

</div>
@endif

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
    $(".accordion-titulo").click(function(){
	
        var contenido=$(this).next("#accordion-content");
                
        if(contenido.css("display")=="none"){ //open		
            contenido.slideDown(250);			
            $(this).addClass("open");
        }
        else{ //close		
            contenido.slideUp(250);
            $(this).removeClass("open");	
        }
                                
    });
       
    document.getElementById('filter').onclick = function() {
        document.getElementById("categories").classList.toggle("hidden");
    }
    document.getElementById('close-menu').onclick = function() {
        document.getElementById("categories").classList.toggle("hidden");
    }
           
</script>
@endpush
</div>