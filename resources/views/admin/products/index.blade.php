@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Column -->      
    @livewire('admin.admin-product-component')

</div>
@endsection

@push('css')

@endpush

@push('scripts')
    <!-- This is data table -->
    <script src="{{url('assets/node_modules/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/node_modules/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/node_modules/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">

    $('#liProducts').addClass("active");

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

    window.livewire.on('productDeleted',()=>{

        $.toast({
            heading: 'Notificación',
            text: 'El Producto se eliminó con éxito.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'info',
            hideAfter: 3500, 
            stack: 6
        });
    });
    
    window.livewire.on('productDeleted_e',()=>{

        $.toast({
            heading: 'Notificación',
            text: 'El Prducto se encuetra asignado a una Entrada, no puede ser eliminada.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 3500, 
            stack: 6
        });
    });


    </script>
@endpush    