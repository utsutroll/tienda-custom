@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Column -->      
    @livewire('admin.admin-product-output-component')

</div>
@endsection

@push('css')
    <!--wzard CSS -->
    <link href="{{url('assets/node_modules/wizard/steps.css')}}" rel="stylesheet">
    <!--alerts CSS -->
    <link href="{{url('assets/node_modules/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">

@endpush

@push('scripts')
    <!-- This is data table -->
    <script src="{{url('assets/node_modules/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/node_modules/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
    <script src="{{url('assets/node_modules/moment/min/moment.min.js')}}"></script>
    <script src="{{url('assets/node_modules/wizard/jquery.steps.min.js')}}"></script>
    <script src="{{url('assets/node_modules/wizard/jquery.validate.min.js')}}"></script>
    <!-- Sweet-Alert  -->
    <script src="{{url('assets/node_modules/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{url('assets/node_modules/wizard/steps.js')}}"></script>
    
    <script type="text/javascript">

    $('#liAlmacen').addClass("active");
    $('#liOutput').addClass("active");
    $('#AOutput').addClass("active");

    @if (session('info'))
        $.toast({
            heading: 'Notificación',
            text: '{{ session('info') }}',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
        });
    @endif

    </script>
@endpush    