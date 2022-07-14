<div>
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Listado Salida de Productos</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Listado Salida de Productos</li>
                </ol>
                <a class="btn btn-success btn-md float-right m-l-15" href="{{route('admin.product-output.create')}}"><i class="fa fa-plus-circle"></i> Nueva Salida</a> 
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.output.pdf') }}" class="btn btn-secondary" title="Exportar a PDF"><i class="fa fa-file-pdf-o fa-2x"></i></a>
            </div>   
        </div>
        <div class="card-body">
            <h4 class="card-title">Productos</h4>
            
            <div class="table-responsive m-t-2">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha de Salida</th>
                            <th>Observación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->characteristic_product->product->name }} {{ $product->characteristic_product->product->brand->name }} {{ $product->characteristic_product->characteristic->name }}</td>
                            <td width="20%">{{ $product->quantity }}</td>
                            <td width="20%">{{ date('d-m-Y', strtotime($product->output->date)) }} {{ date('h:i:s A', strtotime($product->output->time))  }}</td>
                            <td>{{ $product->observation }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>       
    </div>
</div>
