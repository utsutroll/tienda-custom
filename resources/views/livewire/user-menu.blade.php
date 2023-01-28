<li>
    @if(Route::has('login'))
        @auth  
        <div class="">
            <button type="button" class="flex text-md focus:outline-none" id="user-menu" aria-expanded="false" aria-haspopup="true">
                <i class="text-lg far fa-user-circle"></i>
            </button>

            <div class="z-40 md:origin-top-right lg:origin-top-right absolute md:right-0 lg:right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden" id="resultnav" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
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
        <button type="button" class="flex text-md focus:outline-none" id="user-menu" aria-expanded="false" aria-haspopup="true">
            <i class="text-lg far fa-user-circle"></i>
        </button>
        <div class="z-40 md:origin-top-right lg:origin-top-right absolute md:right-0 lg:right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden" id="resultnav" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
            <a href="{{ route('login') }}" class="text-gray-800 px-4 py-2 rounded-md text-base font-medium">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="text-gray-800 px-4 py-2 rounded-md text-base font-medium">Registrarse</a>    
        </div>
        @endauth
    @endif 
</li> 