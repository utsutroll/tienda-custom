<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="La Mega Tienda Turén">
        <meta name="author" content="SpaceDigitalSolutions">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{url('/assets/images/favicon.svg')}}">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- chartist CSS -->
        <link href="{{asset('assets/node_modules/morrisjs/morris.css')}}" rel="stylesheet">
        <!--Toaster Popup message CSS -->
        <link href="{{asset('assets/node_modules/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
        <!-- Dashboard 1 Page CSS -->
        <link href="{{asset('dist/css/pages/dashboard1.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @stack('css')
        <!-- Styles -->

        @livewireStyles

    </head>
    <body class="skin-default fixed-layout">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label" style="color: red;">La Mega Tienda Turén</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            @include('partials.topbar')
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            @include('partials.left-sidebar')
            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                {{ $slot }}
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
                @livewire('admin.admin-update-price-component') 
                @livewire('admin.admin-update-dollar-component')
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                @include('partials.right-sidebar')
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            @include('partials.footer')
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>    
        @livewireScripts
    
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="{{asset('assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
        <!-- Bootstrap popper Core JavaScript -->
        <script src="{{asset('assets/node_modules/popper/popper.min.js')}}"></script>
        <script src="{{asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="{{asset('dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
        <!--Wave Effects -->
        <script src="{{asset('dist/js/waves.js')}}"></script>
        <!--Menu sidebar -->
        <script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
        <!--Custom JavaScript -->
        <script src="{{asset('dist/js/custom.min.js')}}"></script>
        <script src="{{asset('assets/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
        <!-- Popup message jquery -->
        <script src="{{asset('assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
        <!-- Date Picker Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        @stack('scripts')
        <script>
            window.livewire.on('dollarEdited',()=>{
                $('#modalUpdatePriceDolar').modal('hide');
    
                $.toast({
                    heading: 'Notificación',
                    text: 'La Tasa del Dólar se actualizó con éxito.',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'success',
                    hideAfter: 3500, 
                    stack: 6
                });
            });

            @if (session('info_p'))
                $('#modalUpdatePrice').modal('hide');
                $.toast({
                    heading: 'Notificación',
                    text: '{{session('info_p')}}',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'success',
                    hideAfter: 3500, 
                    stack: 6
                }); 
            @endif

            window.livewire.on('orderUpdateA',()=>{
    
                $.toast({
                    heading: 'Notificación',
                    text: 'El Pago se aprobó con exito.',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'success',
                    hideAfter: 3500, 
                    stack: 6
                });
            });
            
            window.livewire.on('orderUpdateC',()=>{
                $('#modalUpdatePriceDolar').modal('hide');
    
                $.toast({
                    heading: 'Notificación',
                    text: 'El Pago se Canceló con exito.',
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