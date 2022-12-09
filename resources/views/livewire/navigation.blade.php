<section id="header">

        <div class="-my-2 -mr-2 md:hidden">
            @if(Route::has('login'))
                @auth  
                <div class="">
                    <button type="button" class="mt-2 inline-flex items-center justify-center" id="users-menu" aria-expanded="false">
                        <span class="sr-only">Open menu</span>
                        <!-- Heroicon name: outline/bars-3 -->
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                            <path d="M12 2A10.13 10.13 0 0 0 2 12a10 10 0 0 0 4 7.92V20h.1a9.7 9.7 0 0 0 11.8 0h.1v-.08A10 10 0 0 0 22 12 10.13 10.13 0 0 0 12 2zM8.07 18.93A3 3 0 0 1 11 16.57h2a3 3 0 0 1 2.93 2.36 7.75 7.75 0 0 1-7.86 0zm9.54-1.29A5 5 0 0 0 13 14.57h-2a5 5 0 0 0-4.61 3.07A8 8 0 0 1 4 12a8.1 8.1 0 0 1 8-8 8.1 8.1 0 0 1 8 8 8 8 0 0 1-2.39 5.64z"></path>
                            <path d="M12 6a3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4zm0 6a1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2 1.91 1.91 0 0 1-2 2z"></path>
                        </svg>
                    </button>

                    <div class="z-40 md:origin-top-right lg:origin-top-right absolute md:right-0 lg:right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden" id="resultsnav" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                        @if (Auth::user()->utype === 'ADM')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Panel Administrativo</a>    
                        @else
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Perfil</a>
                            {{-- <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Panel Administrativo</a> --}}
                            <a href="{{ route('user.orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Mis Pedidos</a>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" onclick="event.preventDefault();
                        this.closest('form').submit();">Cerrar Sesión</a>
                        </form>
                        
                    </div>
                </div>
            
            @else
                <button type="button" class="mt-2 inline-flex items-center justify-center" id="users-menu" aria-expanded="false">
                    <span class="sr-only">Open menu</span>
                    <!-- Heroicon name: outline/bars-3 -->
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <path d="M12 2A10.13 10.13 0 0 0 2 12a10 10 0 0 0 4 7.92V20h.1a9.7 9.7 0 0 0 11.8 0h.1v-.08A10 10 0 0 0 22 12 10.13 10.13 0 0 0 12 2zM8.07 18.93A3 3 0 0 1 11 16.57h2a3 3 0 0 1 2.93 2.36 7.75 7.75 0 0 1-7.86 0zm9.54-1.29A5 5 0 0 0 13 14.57h-2a5 5 0 0 0-4.61 3.07A8 8 0 0 1 4 12a8.1 8.1 0 0 1 8-8 8.1 8.1 0 0 1 8 8 8 8 0 0 1-2.39 5.64z"></path>
                        <path d="M12 6a3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4zm0 6a1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2 1.91 1.91 0 0 1-2 2z"></path>
                    </svg>
                </button>
                <div class="z-40 md:origin-top-right lg:origin-top-right absolute md:right-0 lg:right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden" id="resultsnav" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                    <a href="{{ route('login') }}" class="text-gray-800 px-4 py-2 rounded-md text-base font-medium">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="text-gray-800 px-4 py-2 rounded-md text-base font-medium">Registrarse</a>    
                </div>
                @endauth
            @endif
            
        </div>
        <a href="/" class="ml-4"> <img src="{{ url('dist/new/img/footer-meka.png') }}" class="logo" alt="Inversiones Meka"></a>

    <div>
        <ul id="navbar">
            <li><a id="LiHome" href="/">Inicio</a></li>
            <li><a id="LiShop" href="{{ route('shop') }}">Tienda</a></li>
            <li><a id="LiOffer" href="{{ route('offer') }}">Ofertas</a></li>
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
        <a href="{{ route('wishlist') }}"><i class="fa fa-heart"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>

    
</section>
