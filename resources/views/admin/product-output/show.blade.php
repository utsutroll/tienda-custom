@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Detalle de la Salida del Producto</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.product-output.index')}}">Listado de Productos</a></li>
                    <li class="breadcrumb-item active">Detalle del Producto</li>
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
                     {{-- {{dd($product)}} --}} 
                    <h3 class="">{{$product[0]->product}}</h3>
                    <h6 class="card-subtitle"></h6>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="white-box text-center"> <img src="{{Storage::url($product[0]->url)}}" class="img-responsive"> </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-6">
                            <h4 class="box-title m-t-40">Descripción del Producto</h4>
                            <p>{{$product[0]->details}}</p>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h3 class="box-title m-t-40">Información General</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        
                                        <tr>
                                            <td width="390">Fecha de Salida</td>
                                            <td> {{$product[0]->date}} {{$product[0]->time}} </td>
                                            
                                        </tr>
                                        <tr>
                                            <td width="390">Cantidad</td>
                                            <td> {{$product[0]->quantity}}</td>
                                        </tr>
                                        <tr>
                                            <td width="390">Presentación</td>
                                            <td> {{$product[0]->present}} {{$product[0]->medida}}</td>
                                        </tr>
                                        <tr>
                                            <td>Categoría</td>
                                            <td> {{$product[0]->cat}} </td>
                                        </tr>
                                        <tr>
                                            <td>Observación</td>
                                            <td> {{$product[0]->observation}} </td>
                                        </tr>
                                        {{-- <tr>
                                            <td>Etiquetas</td>
                                            <td> 
                                                @foreach ($tags= App\Models\Product_tag::where('product_id', $product[0]->product_id)->get() as $t)
                                                    <span class="badge badge-info">{{$t->name}}</span>    
                                                @endforeach
                                            </td>
                                        </tr> --}}
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
    <link href="{{asset('dist/pages/ecommerce.css')}}" rel="stylesheet">
@endpush
@push('scripts')
<script>

    $('#liAlmacen').addClass("active");
    $('#liOutput').addClass("active");
    $('#AOutput').addClass("active");
   
</script>
@endpush    