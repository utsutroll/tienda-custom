<x-guest-layout>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(../assets/images/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body p-40">
                <form class="form-horizontal form-material mt-20" id="loginform" method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <a href="/" class="flex justify-center"><img src="{{asset('/assets/images/logo/logo-main-text.svg')}}" class="h-10 w-auto" alt="Inicio" /></a>
                    <h3 class="box-title m-t-40 m-b-0">Esta es una zona segura de la aplicación.</h3><small> Por favor, confirme su contraseña antes de continuar.</small>

                    <div class="form-group m-t-20">
                        <div class="col-xs-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Contraseña">
                        </div>
                        @error('password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-block text-uppercase waves-effect waves-light btn-rounded" type="submit">Comfirmar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-guest-layout>
