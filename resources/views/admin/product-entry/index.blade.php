@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Column -->      
    @livewire('admin.admin-product-entry-component')

</div>
@endsection

@push('css')
    
@endpush

@push('scripts')
    <!-- This is data table -->
    <script src="{{asset('assets/node_modules/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/wizard/jquery.validate.min.js')}}"></script>

    <script type="text/javascript">

    $('#liAlmacen').addClass("active");
    $('#liEntry').addClass("active");
    $('#AEntry').addClass("active");

    @if (session('info'))
        $.toast({
            heading: 'Notificación',
            text: '{{session('info')}}',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          }); 
    @endif

    @if (session('info_e'))
        $.toast({
            heading: 'Notificación',
            text: '{{session('info_e')}}',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          }); 
    @endif
    </script>
@endpush    