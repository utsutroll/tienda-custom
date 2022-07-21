<footer class="section-p1 bg-gray-100">
    <div class="coll">
        <img class="logo" src="{{ url('dist/new/img/footer-meka.png') }}" alt="Inversiones Meka">
        <h4 class="text-lg text-teal-600 font-semibold">Contacto</h4>
        <p><strong>Dirección:</strong> Plasoleta el saman</p>
        {{-- <p><strong>Teléfono:</strong> +01 2222 356 /(+91) 01 2345 6789</p> --}}
        <p><strong>Correo:</strong> inversiones.meka@hotmail.com</p>
        <p><strong>Horario:</strong> 7:30 - 16:00, Lunes a Sabados</p>

        <div class="follow">
            <h4 class="text-lg text-teal-600 font-semibold">Siguenos</h4>
            <div class="icon">
                <a href="https://instagram.com/inversionesmekaca" target="_blank"><i class="fab fa facebook-f"></i></a>
                <a href="https://instagram.com/inversionesmekaca" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <div class="coll">
        <h4 class="text-lg text-teal-600 font-semibold">Nosotros</h4>
        <a href="{{ route('shop') }}">Tienda</a>
        <a href="{{ route('categories') }}">Categorías</a>
        <a href="{{ route('about') }}">Sobre Nosotros</a>
        {{-- <a href="#">Delivery Information</a> --}}
    </div>
    
    <div class="coll">
        <h4 class="text-lg text-teal-600 font-semibold">Mi Cuenta</h4>
        @if(Route::has('login'))
            @auth

                @if (Auth::user()->utype === 'ADM')
                    <a href="{{ route('admin.dashboard') }}">Panel Administrativo</a>
                @else
                    <a href="{{ route('profile.show') }}">Perfil</a>
                    <a href="{{ route('user.dashboard') }}">Panel Administrativo</a>
                    <a href="{{ route('user.orders') }}">Mis Pedidos</a>
                @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        this.closest('form').submit();">Cerrar Sesión</a>
                    </form>
        @else
                <a href="{{ route('login') }}">Iniciar Sesión</a>
                <a href="{{ route('register') }}">Registrarse</a>
            @endauth
        @endif 
            
    </div>

    <div class="coll install">
        <p class="text-lg text-teal-600 font-semibold">Métodos de pago </p>
        <img src="{{ url('dist/new/img/paymethod.png') }}" class="w-52" alt="">
    </div>

    <div class="copyright">
        <p>Inversiones Meka C.A J407833898 | 2022 Todos los Derechos Reservados <br>Web Elaborada por <a href="https://instagram.com/spacedigitalsolitions" target="_blank">SpaceDigital Solucions C.A</a></p>
    </div>
</footer>