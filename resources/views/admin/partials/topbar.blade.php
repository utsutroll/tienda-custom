<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('/')}}">
                <!-- Logo icon -->
                <b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{ url('dist/new/img/logos/phone-dark.svg') }}" alt="homepage" class="dark-logo" width="15%"/>
                    <!-- Light Logo icon -->
                    <img src="{{ url('dist/new/img/logos/phone-light.svg') }}" alt="homepage" class="light-logo" width="15%"/>
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span>
                    <!-- dark Logo text -->
                    <img src="{{ url('dist/new/img/logos/letras-dark.svg') }}" alt="homepage" class="dark-logo" width="50%"/>
                    <!-- Light Logo text -->    
                    <img src="{{ url('dist/new/img/logos/letras-light.svg') }}" class="light-logo" alt="homepage" width="50%"/>
                </span> 
             </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->
                <li class="nav-item"> 
                    <a class="nav-link waves-effect waves-dark" title="Actualizar Precio del Dólar" aria-expanded="false" data-toggle="modal" data-target="#modalUpdatePriceDolar">
                        <i class="fa fa-dollar"></i>
                    </a>
                </li>
        
                @livewire('notification-admin')
                <!-- ============================================================== -->
                <!-- End Comment -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- User Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{-- <img src="../assets/images/users/1.jpg" alt="user" class=""> --}} 
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="">
                        <span class="hidden-md-down text-truncate">{{ Auth::user()->name }} &nbsp;<i class="fa fa-angle-down"></i>
                        </span> 
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <!-- text-->
                        <a href="{{ route('profile.show') }}" class="dropdown-item"><i class="ti-user"></i> Mi Perfil</a>
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                <i class="fa fa-power-off"></i> {{ __('Cerrar Sesión') }}
                            </a>
                        </form> 
                        <!-- text-->
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End User Profile -->
                <!-- ============================================================== -->
                <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
            </ul>
        </div>
    </nav>
</header>