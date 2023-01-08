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

    <div class="w-full p-6 my-6 flex flex-col md:flex-col lg:flex-row lg:justify-between border-b-2">
        @if (!empty($this->category))
        <h1 class="text-xl md:text-3xl lg:text-4xl font-bold font-sans">Categoría: {{ $this->category }}</h1>    
        @elseif (!empty($this->subcategory))
        <h1 class="text-xl md:text-3xl lg:text-4xl font-bold font-sans">Subcategoría: {{ $this->subcategory }}</h1>
        @else
        <h1 class="text-xl md:text-3xl lg:text-4xl font-bold font-sans">Categorías</h1>
        @endif

        @if (!empty($this->subcategories) | !empty($this->products))
        <div class="mt-5">
            <div class="flex justify-end md:justify-end">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
                <span wire:click="refresh()" class="text-md hover:underline cursor-pointer font-semibold font-sans">Elegir otra Categoría</span>
            </div>
        </div> 
        @endif
    </div>
    
    <div wire:loading class="preloader">
        <div class="loader">
            <div>
                <img class="animate-pulse w-16" src="{{ asset('dist/new/img/logos/logo-meka.svg') }}" alt="Inversiones Meka">
            </div>    
        </div>
    </div>
        
    @if (empty($this->subcategories) & empty($this->products)) 
    <div class="h-screen">    
        <div wire:loading.remove wire:target="subcategories" class="grid grid-cols-2 sm:grid-cols-4 sm-gap-3 md-cols-4 md:gap-4 lg:grid-cols-4 lg:gap-6 mx-2 p-6">
            @foreach ($this->categories as $category)
            <div class="bg-gray-200 rounded-md shadow-sm hover:shadow-lg shadow-black">
                <h3 class="px-2 pt-8 text-base font-semibold font-sans">{{ $category->name }}</h3>
                <div wire:click="subcategories({{ $category->id }})" class="bg-gradient-to-r from-green-500 to-blue-500 rounded-b-md flex m-0 justify-end cursor-pointer">
                    <i class="fas fa-plus text-gray-100 p-1"></i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if (!empty($this->subcategories)) 
    <div class="h-screen">  
        <div wire:loading.class="hidden" wire:target="products" class="grid grid-cols-2 sm:grid-cols-4 sm-gap-3 md-cols-4 md:gap-4 lg:grid-cols-4 lg:gap-6 mx-2 p-6">
            @foreach ($this->subcategories as $subcategory)

            <div class="bg-gray-200 rounded-md shadow-sm hover:shadow-lg shadow-black">
                <h3 class="px-2 pt-8 text-base font-semibold font-sans">{{ $subcategory->name }}</h3>
                <div wire:click="products({{  $subcategory->id }})" class="bg-gradient-to-r from-blue-500 to-green-500 rounded-b-md flex m-0 justify-end cursor-pointer">
                    <i class="fas fa-plus text-gray-100 p-1"></i>
                </div>
            </div>
            @endforeach
        </div> 
    </div> 

        @if (count($this->subcategories) == 0 & $this->category != null)
        <div class="my-4 h-48 text-center">
            <h5 class="text-base font-sans font-semibold text-gray-800">No se encontraron subcategorías asociadas a la categoría: {{ $this->category }}</h5>
        </div>
        @endif
    @endif


    @if ($this->subcategories == null & $this->subcategory != null & !empty($this->products))
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            @if (count($this->products) > 0)

            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($this->products as $p)
                <div class="group relative border border-green-200 rounded-tr-3xl rounded-3xl hover:shadow-lg shadow-black">
                    <div class="w-full min-h-80 bg-gray-200 rounded-t-3xl aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        @isset ($p->imagen)
                        <a href="{{route('product.details',['slug'=>$p->slug])}}">
                            <img loading="lazy" src="{{Storage::url($p->imagen)}}" alt="{{$p->product}}" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                        </a>
                        @endisset
                    </div>
                    <div class="py-4 px-4 flex-row">
                        <div>
                            <p class="my-2 text-sm text-gray-500">{{ $p->brand }}</p>
                            <h3 class="text-sm font-medium text-gray-900">
                                <a href="{{route('product.details',['slug'=>$p->slug])}}">
                                    <span aria-hidden="true" class="absolute"></span>
                                    {{ $p->product }}
                                </a>
                            </h3>
                        </div>
                        <p class="text-md mt-2 text-center font-semibold text-teal-600">@foreach ($dollar as $d){{ number_format($d->price * $p->price, 2) }}@endforeach Bs</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="my-4 text-center">
                <h5 class="text-base font-sans font-semibold text-gray-800">No hay productos asociados a la subcategoría: {{ $this->subcategory }}</h5>
            </div>
            @endif
        </div>
    </div>
    @endif     
</div>

@push('scripts')
<script>
    $('#LiCategory').addClass("active");           
</script>
@endpush