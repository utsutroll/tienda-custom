@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Column -->      
    @livewire('admin.admin-slider-component')

</div>
@endsection

@push('css')

@endpush

@push('scripts')
    <!-- This is data table -->
    <script src="{{url('assets/node_modules/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/node_modules/moment/min/moment.min.js')}}"></script>

    <script type="text/javascript">

    $('#liSlider').addClass("active");

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

    window.livewire.on('sliderDeleted',()=>{

        $.toast({
            heading: 'Notificación',
            text: 'La Promoción se eliminó con éxito.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'info',
            hideAfter: 3500, 
            stack: 6
        });
    });
    
    window.livewire.on('sliderDeleted_e',()=>{

        $.toast({
            heading: 'Notificación',
            text: 'Ocurrió un Error, no se pudo eliminar el registro.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 3500, 
            stack: 6
        });
    });


    </script>
@endpush    