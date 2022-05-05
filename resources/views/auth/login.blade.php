<x-guest-layout>

    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(../assets/images/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body p-40">
                    
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
    
                <form class="form-horizontal form-material mt-40" id="loginform" method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf
                        <a href="/" class="flex justify-center"><img src="{{asset('assets/images/logo/logo-main-text.svg')}}" class="h-10 w-auto" alt="Inicio" /></a>
                        <div class="form-group m-t-40">
                            <div class="col-xs-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Correo Electrónico" autofocus>
                            </div>
                            @error('email')
                                <small class="text-danger">{{$message}}</small>   
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Contraseña">
                            </div>
                            @error('password')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customCheck1">Recordar</label>
                                    @if (Route::has('password.request'))
                                        <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> ¿Olvidó la Contraseña?</a> 
                                    @endif
                                </div>     
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-block text-uppercase btn-rounded" type="submit">Entrar</button>
                            </div>
                        </div>
    
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                ¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-danger m-l-5"><b>Regístrate</b></a>
                            </div>
                        </div>
                </form>
                <form class="form-horizontal" id="recoverform" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recuperar Contraseña</h3>
                                <p class="text-muted">Introduzca su correo electrónico y se le enviarán las instrucciones. </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input id="emails" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Correo Electrónico">
                            </div>
                            @error('email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-rounded btn-block text-uppercase waves-effect waves-light" type="submit">Restablecer</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </section>
</x-guest-layout>
