<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{url('favicon.svg')}}">

        <!-- FontAwesome Pro -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="stylesheet" href="{{ url('dist/new/css/styles.css') }}">
        <link rel="stylesheet" href="{{asset('dist/css/style-custom.css')}}">

        @livewireStyles
        {{-- <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('/assets/node_modules/prism/prism.css')}}">
        <link href="{{asset('/assets/node_modules/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/assets/node_modules/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/node_modules/glider.js-master/glider.min.css')}}" rel="stylesheet" />
        <link href="{{asset('dist/pages/ecommerce.css')}}" rel="stylesheet">
         --}}
        <!--Toaster Popup message CSS -->
        <link href="{{asset('/assets/node_modules/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.1.0/dist/flowbite.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.min.css">
        <link href="{{asset('assets/node_modules/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>
        @stack('css')
        <style>
            .notify-m{
                top: -10px;
                right: -1px;
                color: red;
                position: relative;
            }
            .notify-m .heartbit-m{
                position: absolute;
                top: -2px;
                right: -7px;
                height: 25px;
                width: 25px;
                z-index: 10;
                border: 5px solid #e46a76;
                border-radius: 70px;
                -moz-animation: heartbit 1s ease-out;
                -moz-animation-iteration-count: infinite;
                -o-animation: heartbit 1s ease-out;
                -o-animation-iteration-count: infinite;
                -webkit-animation: heartbit 1s ease-out;
                -webkit-animation-iteration-count: infinite;
                animation-iteration-count: infinite;
            }
            .animate-pulse	{ animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;}
            @keyframes pulse {
                0%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: .2;
                }
            }
            .w-16 {
                width: 10rem;
            }
        </style>
        <!-- Scripts -->
        
        <script src="{{ url('dist/new/js/script.js') }}"></script>
    </head>
    <body class="font-sans flex flex-col min-h-screen">

        <div class="preloader">
            <div class="loader">
                <div>
                   <img class="animate-pulse w-16" src="{{ asset('dist/new/img/logos/logo-meka.svg') }}" alt="Inversiones Meka">
                </div>    
            </div>
        </div>


        @include('livewire.navigation')
            
        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>


        @stack('modals')

        <a href="https://api.whatsapp.com/send?phone=" class="float-b" target="_blank">
            <i class="fab fa-whatsapp my-float-b"></i>
        </a>

        @include('partials.footer-base')

        @livewireScripts
        <script src="{{asset('/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
        <!-- Bootstrap popper Core JavaScript -->
        {{-- <script src="{{asset('/assets/node_modules/popper/popper.min.js')}}"></script>
        <script src="{{asset('/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="{{asset('/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
        <script src="{{asset('assets/node_modules/prism/prism.js')}}"></script> --}}
        <script src="{{asset('/dist/js/carrusel-app.js')}}" type="text/javascript"></script>  
        <!-- Popup message jquery -->
        <script src="{{asset('/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
        <script src="https://unpkg.com/@themesberg/flowbite@1.1.0/dist/flowbite.bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
        <script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        
        @stack('scripts')
        <script>
            $(function () {
                $(".preloader").fadeOut();
            });

            window.livewire.on('addCartError',()=>{
    
                $.toast({
                    heading: 'Notificación',
                    text: 'El producto se quedó sin stock.',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'success',
                    hideAfter: 3500, 
                    stack: 6
                });
            });

            document.getElementById('users-menu').onclick = function() {
                document.getElementById("resultsnav").classList.toggle("hidden");
            }

            document.getElementById('user-menu').onclick = function() {
                document.getElementById("resultnav").classList.toggle("hidden");
            }

            document.getElementById('bar').onclick = function() {
                document.getElementById("navbar").classList.toggle("active");
            }

            document.getElementById('close').onclick = function() {
                document.getElementById("navbar").classList.toggle("active");
            }

        </script>
    </body>
</html>
