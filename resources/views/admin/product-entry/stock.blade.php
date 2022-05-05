@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Column -->      
    @livewire('admin.admin-stock-component')

</div>
@endsection

@push('css')

@endpush

@push('scripts')
    <!-- This is data table -->
    <script src="{{url('assets/node_modules/datatables/jquery.dataTables.min.js')}}"></script>

    <script type="text/javascript">

    $('#liAlmacen').addClass("active");
    $('#liStock').addClass("active");
    $('#AStock').addClass("active");

    </script>
@endpush    