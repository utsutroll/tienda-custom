<nav class="bg-white shadow-sm" x-data="{ open:false }">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
  
        <!-- Mobile menu button-->  
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          
          <button x-on:click=" open = true " type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Abrir menú principal</span>

            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
  
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <!-- Logo-->  
          <a href="/" class="flex-shrink-0 flex items-center">
            <img class="block lg:hidden h-10 w-auto" src="{{asset('assets/images/logo/logo-main.svg')}}" alt="LaMegaTiendaTuren">
            <img class="hidden lg:block h-10 w-auto" src="{{asset('assets/images/logo/logo-main-text.svg')}}" alt="LaMegaTiendaTuren">
          </a>
  
        </div>
  
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
           
          <!-- Profile dropdown -->
          @if(Route::has('login'))
            @auth  
            @livewire('notifications')
            <div class="ml-3 relative" x-data="{ open: false }">
              <div>
                <button x-on:click=" open = true " type="button" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-expanded="false" aria-haspopup="true">
                  <span class="sr-only">Abrir menú de usuario</span>
                  <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="">
                </button>
              </div>

              <div x-show="open" x-on:click.away=" open = false " 
                  x-transition:enter="transition ease-out duration-100"
                  x-transition:enter-start="transform opacity-0 scale-95"
                  x-transition:enter-end="transform opacity-100 scale-100"
                  x-transition:leave="transition ease-in duration-75"
                  x-transition:leave-start="transform opacity-100 scale-100"
                  x-transition:leave-end="transform opacity-0 scale-95"
                  class="z-40 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                
                @if (Auth::user()->utype === 'ADM')
                  <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Panel Administrativo</a>    
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
            </div>
       
            @else
            <a href="{{ route('login') }}" class="text-gray-800 hover:bg-red-600 hover:text-white hidden sm:block px-3 py-2 rounded-md text-base font-medium">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="text-gray-800 hover:bg-red-600 hover:text-white hidden sm:block px-3 py-2 rounded-md text-base font-medium">Registrarse</a>     
          @endauth
        @endif    
        </div>
      </div>
    </div>
  
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-show="open" x-on:click.away=" open = false ">
      <div class="px-2 pt-2 pb-3 space-y-1">
        @if (Route::has('login'))
            @auth
              @if (Auth::user()->utype === 'ADM')
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Panel Administrativo</a>    
              @else
                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tu Perfil</a>
                <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Panel Administrativo</a>
                <a href="{{ route('user.orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Mis Ordenes</a>
              @endif

              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" onclick="event.preventDefault();
                this.closest('form').submit();">Cerrar Sesión</a>
              </form>
            @else
              <a href="{{ route('login') }}" class="text-gray-800 hover:bg-red-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Iniciar Sesión</a>
              <a href="{{ route('register') }}" class="text-gray-800 hover:bg-red-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Registrarse</a>
            @endauth
        @endif
      </div>
    </div>
</nav>