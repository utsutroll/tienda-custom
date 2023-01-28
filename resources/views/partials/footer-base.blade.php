<footer class="section-p1 bg-gray-200">
    <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        <div class="col">
            <img class="logo" src="{{ url('dist/new/img/footer-meka.png') }}" alt="Inversiones Meka">
            <h4 class="text-lg text-teal-600 font-semibold">Contacto</h4>
            <p><strong>Dirección:</strong> Plazoleta el Samán</p>
            {{-- <p><strong>Teléfono:</strong> +01 2222 356 /(+91) 01 2345 6789</p> --}}
            <p><strong>Correo:</strong> inversiones.meka@hotmail.com</p>
            <p><strong>Horario:</strong> 7:30 Am - 04:00 Pm, Lunes a Sábados</p>

            <div class="follo">
                <h4 class="text-lg text-teal-600 font-semibold">Síguenos</h4>
                <div class="icon">
                    <a href="https://instagram.com/inversionesmekaca" target="_blank"><i class="fab fa facebook-f"></i></a>
                    <a href="https://instagram.com/inversionesmekaca" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        
        <div class="col">
            <h4 class="text-lg text-teal-600 font-semibold">Nosotros</h4>
            <a href="{{ route('shop') }}">Tienda</a><br>
            <a href="{{ route('categories') }}">Categorías</a><br>
            <a href="{{ route('about') }}">Sobre Nosotros</a>
            {{-- <a href="#">Delivery Information</a> --}}
        </div>
        
        <div class="col">
            <h4 class="text-lg text-teal-600 font-semibold">Mi Cuenta</h4>
            @if(Route::has('login'))
                @auth

                    @if (Auth::user()->utype === 'ADM')
                        <a href="{{ route('admin.dashboard') }}">Panel Administrativo</a>
                    @else
                        <a href="{{ route('profile.show') }}">Perfil</a><br>
                        {{-- <a href="{{ route('user.dashboard') }}">Panel Administrativo</a> --}}
                        <a href="{{ route('user.orders') }}">Mis Pedidos</a>
                    @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            this.closest('form').submit();">Cerrar Sesión</a>
                        </form>
            @else
                    <a href="{{ route('login') }}">Iniciar Sesión</a><br>
                    <a href="{{ route('register') }}">Registrarse</a>
                @endauth
            @endif 
                
        </div>

        <div class="col instal">
            <p class="text-lg text-teal-600 font-semibold">Métodos de pago </p>
            <img src="{{ url('dist/new/img/paymethod.png') }}" class="w-52" alt="">
        </div>
    </div>

    <div class="copyright mt-5">
        <p>Inversiones Meka C.A J407833898 | 2022 Todos los Derechos Reservados <br>Web Elaborada por <a href="https://instagram.com/spacedigitalsolitions" target="_blank">SpaceDigital Solucions C.A</a></p>
    </div>
</footer>