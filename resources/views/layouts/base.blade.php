<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{url('/assets/images/favicon.svg')}}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-EDPVXK5MPB"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-EDPVXK5MPB');
        </script>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles
        <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('/assets/node_modules/prism/prism.css')}}">
        <link href="{{asset('/assets/node_modules/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/assets/node_modules/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/node_modules/glider.js-master/glider.min.css')}}" rel="stylesheet" />
        <link href="{{asset('dist/pages/ecommerce.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('dist/css/style-custom.css')}}">
        <!--Toaster Popup message CSS -->
        <link href="{{asset('/assets/node_modules/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
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
        </style>
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label" style="color: red;">La Mega Tienda Turén</p>
            </div>
        </div>
        <div class="min-h-screen bg-gray-100 m-auto">
            @include('livewire.navigation')
            
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        <footer class="footer flex ml-0">
            © 2021 La Mega Tienda Turén by <a href="https://instagram.com/spacedigitalsolutions" title="Instagram de Space DicitalSolutions C.A" class="ml-1 hover:text-blue-600 flex" target="_blank">
                 Space DigitalSolutions C.A <i class="mt-1"><svg class="hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M13 3L16.293 6.293 9.293 13.293 10.707 14.707 17.707 7.707 21 11 21 3z"></path><path d="M19,19H5V5h7l-2-2H5C3.897,3,3,3.897,3,5v14c0,1.103,0.897,2,2,2h14c1.103,0,2-0.897,2-2v-5l-2-2V19z"></path></svg></i>
            </a>
        </footer>

        @livewireScripts
        <script src="{{asset('/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
        <!-- Bootstrap popper Core JavaScript -->
        <script src="{{asset('/assets/node_modules/popper/popper.min.js')}}"></script>
        <script src="{{asset('/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="{{asset('/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
        <script src="{{asset('assets/node_modules/prism/prism.js')}}"></script>
        <script src="{{asset('/dist/js/carrusel-app.js')}}" type="text/javascript"></script>  
        <!-- Popup message jquery -->
        <script src="{{asset('/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
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
        </script>
    </body>
</html>
