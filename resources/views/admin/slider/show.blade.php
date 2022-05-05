@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Detalle de la Promoción</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.slider.index')}}">Listado de Promocines</a></li>
                    <li class="breadcrumb-item active">Detalle de la Promoción</li>
                </ol> 
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Info box Content -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="">{{$slider->title}}</h3>
                    <h6 class="card-subtitle"></h6>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="white-box text-center"> <img src="{{Storage::url($slider->image->url)}}" class="img-responsive"> </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-6">
                            <h4 class="box-title m-t-40">Descripción de la Promoción</h4>
                            <p>{{$slider->detail}}</p>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h3 class="box-title m-t-40">Información General</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="390">Subtítulo</td>
                                            <td> {{$slider->subtitle}}</td>
                                        </tr>
                                        <tr>
                                            <td width="390">Estatus</td>
                                            <td> 
                                                @if ($slider->status == 1)
                                                <span class="badge badge-success">Activo</span> 
                                                @else
                                                <span class="badge badge-secondary">Caducado</span>         
                                                @endif
                                                
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->  

</div>
@endsection
@push('css')
    <!-- chartist CSS -->
    <link href="{{asset('dist/css/pages/ecommerce.css')}}" rel="stylesheet">
@endpush
@push('scripts')

    <script type="text/javascript">

    $('#liSlider').addClass("active");
   
    </script>
@endpush    