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
            <h6 class="card-subtitle"></h6>
            <div class="m-t-4">
                <div class="dataTables_length" id="myTable_length">
                    <label>Mostrar 
                        <select wire:model="entries"  class="">
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> 
                    Entradas</label>
                </div>
                <div class="dataTables_filter">
                    <label>Buscar:
                        <input type="search" wire:model="search" class="" placeholder="Buscar por Fecha">
                        @if ($search !== '')
                        <button class="btn btn-outline-secondary btn-sm waves-effect waves-light" wire:click="clear" type="button"><span class="btn-label"><i class="fa fa-times"></i></span></button>    
                        @endif
                        
                    </label>
                </div>
    
            </div>
            
            <div class="table-responsive m-t-2">
                @if (count($products) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th width="20%">Cantidad</th>
                            <th width="20%" wire:click="order('created_at')" style="cursor:pointer;">Fecha de Entrada
                                {{-- Sort --}}
                                @if ($sort == 'created_at')
                                    @if ($direcction == 'asc')
                                        <i class="fa fa-sort-alpha-asc float-right mt-1"></i>    
                                    @else
                                        <i class="fa fa-sort-alpha-desc float-right mt-1"></i>    
                                    @endif
                                    
                                @else
                                    <i class="fa fa-sort float-right mt-1"></i>
                                @endif
                                
                            </th>
                            <th class="text-nowrap">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product->name }} ({{ $product->product->presentation->name }} {{ $product->product->presentation->medida }})</td>
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
                            <td width="10px" class="text-nowrap">
                                <a 
                                    class="btn btn-secondary btn-sm"
                                    href="{{route('admin.product-entry.show', $product->id)}}">
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
        <div class="card-footer">
            <div class="float-right">
                {{$products->links()}}
            </div>
        </div> 
        @elseif (count($products) == 0 & $search !== '')
            <div class="card-body">
                No hay un resultado para la busqueda "{{$search}}"  
            </div>
            </div>
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Fecha de Entrada</th>
                        <th colspan="2" class="text-nowrap">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td colspan="5">No se Encontraron Registros</td>
                    </tr>
                </tbody>
            </table> 
            </div>
            </div>      
        @endif 
    </div>
</div>
