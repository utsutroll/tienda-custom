<section id="header">
    <a href="/"> <img src="{{ url('dist/new/img/footer-meka.png') }}" class="logo" alt="Inversiones Meka"></a>

    <div>
        <ul id="navbar">
            <li><a id="LiHome" href="/">Inicio</a></li>
            <li><a id="LiShop" href="{{ route('shop') }}">Tienda</a></li>
            <li><a id="LiCategory" href="{{ route('categories') }}">Categorías</a></li>
            <li><a id="LiAbout" href="{{ route('about') }}">Nosotros</a></li>
            <livewire:icon-cart />
            @if(Route::has('login'))
                @auth 
                <livewire:notifications />
                @endauth         
            @endif
            @include('livewire.user-menu')    
            <a href="#" id="close"><i class="far fa-times"></i></a>
        </ul>
    </div>

    <div id="mobile">
        <a href="{{ route('cart') }}"><i class="far fa-shopping-bag"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>
