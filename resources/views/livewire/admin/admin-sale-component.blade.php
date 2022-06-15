<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Listado de Productos en Oferta</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Listado de Productos en oferta</li>
                </ol>
                <a href="{{ route('admin.sale-open') }}" class="btn btn-success btn-md float-right m-l-15">Aperturar Oferta</a>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="card">
        @if ($sale_date > \Carbon\Carbon::now() && $status > 0)
        <div class="card-header bg-white">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.offer.pdf') }}" class="btn btn-secondary" title="Exportar a PDF"><i class="fa fa-file-pdf-o fa-2x"></i></a>
            </div>   
        </div>    
        @endif 
        <div class="card-body">
            <h4 class="card-title">Productos en Oferta</h4>

            <div class="table-responsive m-t-2">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Precio de Oferta</th>
                            <th>Fecha de Culminación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sproducts as $p)
                        
                        <tr>
                            <td width="8%">{{ $p->id }}</td>
                            <td>{{ $p->product->name }} {{ $p->product->brand->name }} {{ $p->characteristic->name }}</td>
                            <td width="10%">{{ $p->price }}$</td>
                            <td>{{ $p->sale_price }}$</td>
                            <td>{{ $sale_date }}</td>
                        </tr> 

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>    
    </div> 
</div>

@push('scripts')

<script type="text/javascript">
    
    $('#liSale').addClass("active");
      
</script>
@endpush