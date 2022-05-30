<section id="header">
  <a href="#"> <img src="{{ url('dist/new/img/logos/logo-meka.svg') }}" class="logo" alt="Inversiones Meka"></a>

  <div>
      <ul id="navbar">
          <li><a id="LiHome" href="/">Inicio</a></li>
          <li><a id="LiShop" href="{{ route('shop') }}">Tienda</a></li>
          <li><a id="LiCategory" href="{{ route('shop') }}">Categorías</a></li>
          <li><a id="LiAbout" href="{{ route('about') }}">Nosotros</a></li>
          <li><a id="LiContact" href="{{ route('contact') }}">Contacto</a></li>
          <livewire:icon-cart />
          <li> <!-- Profile dropdown -->
            @if(Route::has('login'))
              @auth 
              <button type="button" class="text-left text-base group outline-none flex" id="togglemebutton">
                  <span id="lg-bag"><i class="far fa-user-circle"></i></span>
              </button>       
              <div class="z-40 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 hidden transition duration-500" id="resultnav">
                 
              @if (Auth::user()->utype === 'ADM')
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-base text-gray-700 hover:bg-gray-100" role="menuitem">Panel Administrativo</a>    
              @else
                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tu Perfil</a>
                <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Panel Administrativo</a>
                <a href="{{ route('user.orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Mis Órdenes</a>
              @endif 

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" onclick="event.preventDefault();
                  this.closest('form').submit();">Cerrar Sesión</a>
                </form>
              </div>  
              @else
              <button type="button" class="text-left text-base group outline-none" id="togglemebutton">
                <span id="lg-bag"><i class="far fa-user-circle"></i></span>
              </button> 
              <div class="z-40 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden transition duration-500" id="resultnav">
                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Registrarse</a>
              </div>
                @endauth 
            @endif    
            
          </li>
      </ul>
  </div>

  <div id="mobile">
      <a href="{{ route('cart') }}"><i class="far fa-shopping-bag"></i></a>
      <a href="{{ route('wishlist') }}"><i class="far fa-heart"></i></i></a>
      <i id="bar" class="fas fa-outdent"></i>
  </div>
</section>
