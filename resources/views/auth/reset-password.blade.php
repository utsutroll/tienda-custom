<x-guest-layout>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(../assets/images/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body p-40">
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="form-horizontal form-material mt-20" id="loginform" method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <a href="/" class="flex justify-center"><img src="{{asset('/assets/images/logo/logo-main-text.svg')}}" class="h-10 w-auto" alt="Inicio" /></a>
                    <h3 class="box-title m-t-40 m-b-0">Restablecimiento de contraseña</h3>
                    <div class="form-group m-t-20">
                        <div class="col-xs-12">
                            <input id="email" type="email" class="form-control" value="{{ $request->email }}" required autofocus placeholder="Correo Electrónico">
                        </div>
                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">
                        </div>
                        @error('password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmar Contraseña">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-block text-uppercase waves-effect waves-light btn-rounded" type="submit">Restablecer contraseña</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-guest-layout>
