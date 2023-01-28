<div>
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Listado Stock de Productos</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Listado Stock de Productos</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.stock.pdf') }}" class="btn btn-secondary" title="Exportar a PDF"><i class="fa fa-file-pdf-o fa-2x"></i></a>
            </div>   
        </div>
        <div class="card-body">
            <h4 class="card-title">Productos</h4>
            
            <div class="table-responsive m-t-2">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $prod)

                        <tr>
                            <td>{{ $prod->product->id }}</td>
                            <td>{{ $prod->product->name }} ({{ $prod->product->brand->name }} {{ $prod->characteristic->name }})</td>
                            <td>{{ $prod->stock }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
