<x-guest-layout>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(../assets/images/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body p-40">
                <form class="form-horizontal form-material mt-20" id="loginform" method="POST" action="{{ route('register') }}">
                    @csrf
                    <a href="/" class="flex justify-center"><img src="{{asset('/assets/images/logo/logo-main-text.svg')}}" class="h-10 w-auto" alt="Inicio" /></a>
                    <h3 class="box-title m-t-40 m-b-0">Regístrate ahora</h3><small>Crea tu cuenta y disfruta</small>
                    <div class="form-group m-t-20">
                        <div class="col-xs-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="Nombre" autofocus>
                        </div>
                        @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Correo Electrónico">
                        </div>
                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Contraseña">
                        </div>
                        @error('password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmar Contraseña">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-block text-uppercase waves-effect waves-light btn-rounded" type="submit">Regístrate</button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>¿Ya tiene una cuenta? <a href="{{ route('login') }}" class="text-info m-l-5"><b>Inicie sesión</b></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-guest-layout>
