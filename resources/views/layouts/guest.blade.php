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

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <!-- page css -->
        <link href="{{asset('dist/css/pages/login-register-lock.css')}}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">

        <style>
            .list-f{
              list-style: none;
              padding-left: 0;
              font-size: .7rem;
              color: #fff;
            }
            .ir-arriba{
              display:none;
              background-repeat:no-repeat;
              font-size:20px;
              color:black;
              cursor:pointer;
              position:fixed;
              bottom:10px;
              right:10px;
              z-index:2;
            }
          </style>
    </head>
    <body>
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label text-danger">La Mega Tienda Turén</p>
            </div>
        </div>

        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>

    <script src="{{url('/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{url('/assets/node_modules/popper/popper.min.js')}}"></script>
    <script src="{{url('/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{url('dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{url('dist/js/waves.js')}}"></script>
    <!--stickey kit -->
    <script src="{{url('/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{url('/assets/node_modules/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{url('dist/js/custom.min.js')}}"></script>
    <script src="{{url('/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
            irArriba();
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('.page-wrapper').addClass('pt-0');

        function irArriba(){
          $('.ir-arriba').click(function(){ $('body,html').animate({ scrollTop:'0px' },1000); });
          $(window).scroll(function(){
            if($(this).scrollTop() > 0){ $('.ir-arriba').slideDown(600); }else{ $('.ir-arriba').slideUp(600); }
          });
          $('.ir-abajo').click(function(){ $('body,html').animate({ scrollTop:'1000px' },1000); });
        }
    </script>
</html>

