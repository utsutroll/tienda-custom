<div>
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Listado Entrada de Productos</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Listado Entrada de Productos</li>
                </ol>
                <a class="btn btn-success btn-md float-right m-l-15" href="{{route('admin.product-entry.create')}}"><i class="fa fa-plus-circle"></i> Nueva Entrada</a> 
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Productos</h4>
            
            <div class="table-responsive m-t-2">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha de Entrada</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        
                        <tr>
                            <td>{{ $product->characteristic_product->product->name }} ({{ $product->characteristic_product->product->brand->name }} {{ $product->characteristic_product->characteristic->name }})</td>
                            <td width="20%">{{$product->quantity}}</td>
                            <td width="20%">{{$product->entry->date}} {{$product->entry->time}}</td>
    
                             
                            {{-- <td width="10px" class="text-nowrap">
                                <a 
                                    class="btn btn-info btn-sm"
                                    href="{{route('admin.products.edit', $p)}}">
                                    <i class="ti-pencil"></i> 
                                    Editar
                                </a>
                            </td> --}}
                            <td>
                                <a 
                                    class="btn btn-secondary btn-sm"
                                    href="{{ route('admin.product-entry.show', $product->id) }}">
                                    <i class="ti-eye"></i> 
                                    Ver
                                </a>
                            </td>
                            {{-- <td width="10px" class="text-nowrap">
                                <button 
                                    class="btn btn-danger btn-sm"
                                    wire:click="destroy({{$p->id}})">
                                    <i class="ti-trash"></i> 
                                    Eliminar
                                </button>
                            </td> --}}
                        </tr>
    
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>       
    </div>
</div>
