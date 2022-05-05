@if ($views == 'table')
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
                <button type="button" wire:click="$set('views', 'update')" class="btn btn-success btn-md float-right m-l-15"> Aperturar Oferta</button> 
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
        <h6 class="card-subtitle"></h6>
        <div class="m-t-4">
            <div class="dataTables_length" id="myTable_length">
                <label>Mostrar 
                    <select wire:model="entries"  class="">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select> 
                Entradas</label>
            </div>
            <div class="dataTables_filter">
                <label>Buscar:
                    <input type="search" wire:model="search" class="" placeholder="">
                    @if ($search !== '')
                    <button class="btn btn-outline-secondary btn-sm waves-effect waves-light" wire:click="clear" type="button"><span class="btn-label"><i class="fa fa-times"></i></span></button>    
                    @endif
                    
                </label>
            </div>

        </div>
        
        <div class="table-responsive m-t-2">
            @if (count($sproducts) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="8%" wire:click="order('id')" style="cursor:pointer;">ID
                            {{-- Sort --}}
                            @if ($sort == 'id')
                                @if ($direcction == 'asc')
                                    <i class="fa fa-sort-numeric-asc float-right mt-1"></i>    
                                @else
                                    <i class="fa fa-sort-numeric-desc float-right mt-1"></i>    
                                @endif
                                
                            @else
                                <i class="fa fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th wire:click="order('name')" style="cursor:pointer;">Producto
                            {{-- Sort --}}
                            @if ($sort == 'name')
                                @if ($direcction == 'asc')
                                    <i class="fa fa-sort-alpha-asc float-right mt-1"></i>    
                                @else
                                    <i class="fa fa-sort-alpha-desc float-right mt-1"></i>    
                                @endif
                                
                            @else
                                <i class="fa fa-sort float-right mt-1"></i>
                            @endif
                            
                        </th>
                        <th wire:click="order('price')" style="cursor:pointer;">Precio
                            {{-- Sort --}}
                            @if ($sort == 'price')
                                @if ($direcction == 'asc')
                                    <i class="fa fa-sort-numeric-asc float-right mt-1"></i>    
                                @else
                                    <i class="fa fa-sort-numeric-desc float-right mt-1"></i>    
                                @endif
                                
                            @else
                                <i class="fa fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th  wire:click="order('sale_price')" style="cursor:pointer;">Precio de Oferta
                            {{-- Sort --}}
                            @if ($sort == 'sale_price')
                                @if ($direcction == 'asc')
                                    <i class="fa fa-sort-alpha-asc float-right mt-1"></i>    
                                @else
                                    <i class="fa fa-sort-alpha-desc float-right mt-1"></i>    
                                @endif
                                
                            @else
                                <i class="fa fa-sort float-right mt-1"></i>
                            @endif
                            
                        </th>
                        
                        <th>Fecha de Culminación</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($sproducts as $p)
                       
                    <tr>
                        <td width="8%">{{ $p->id }}</td>
                        <td>{{ $p->name }} {{ $p->presentation->name }} {{ $p->presentation->medida }}</td>
                        <td>{{ $p->price }}$</td>
                        <td>{{ $p->sale_price }}$</td>
                        <td>{{ $sale_date }}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="float-right">
            {{$sproducts->onEachSide(5)->links()}}
        </div>
    </div> 
    @elseif (count($sproducts) == 0 & $search !== '')
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
                    <th>Precio</th>
                    <th>Precio de Oferta</th>
                    <th>Fecha de Culminación</th>
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
    
@elseif($views == 'update')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Configurar Ofertas</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)" wire:click="$set('views', 'table')">Listado de Productos en oferta</a></li>
                    <li class="breadcrumb-item active">Configurar Ofertas</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="d-flex justify-content-end align-items-end m-b-15">
        <button wire:click="$set('views', 'import')" class="btn btn-success btn-md"> Precios de oferta</button>
        <button class="btn btn-success btn-md m-l-15" wire:click.prevent="restorePriceOffer" wire:loading.attr="disabled"> Restablecer precios de oferta</button>
    </div>


    <div class="">
        <div class="d-flex justify-content-center">
            
            <div class="card shadow-md">
                <div class="card-body">
                    <h4 class="card-title m-b-15">Fija la fecha y hora en la que termina la oferta</h4>
                    <hr>
                    <form role="form" wire:submit.prevent="updateSale">
                        @csrf
                        <div class="form-group">
                            <label for="">Status</label>
                            <select wire:model="status" class="form-control">
                                <option value="0">Inactivo</option>
                                <option value="1">Activo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Fecha que termina la Oferta</label>
                            <input type="datetime-local" wire:model="sale_date"  min="{{ $sale_date }}" class="form-control" placeholder="DD/MM/AAAA H:M:S">
                        </div>
                        <div class="mt-4 d-flex justify-content-end form-group">
                            <button wire:click="$set('views', 'table')" class="mt-2 btn btn-secondary waves-effect waves-light mr-2">Volver</button>
                            <button type="submit" class="mt-2 btn btn-info waves-effect waves-light">Actualizar</button>
                        </div>
                    </form> 
                </div>  
            </div>
        </div>          
    </div>
</div>
@elseif($views == 'import')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Actualizar Precios de Ofertas</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)" wire:click="$set('views', 'table')">Listado de Productos en oferta</a></li>
                    <li class="breadcrumb-item active">Actualizar Precios de Ofertas</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="d-flex justify-content-center row">
    <div class="card col-10">
        <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#manual" role="tab"><span class="hidden-sm-up"><i class="ti-hand-open"></i></span> <span class="hidden-xs-down">Manual</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#import" role="tab"><span class="hidden-sm-up"><i class="ti-import"></i></span> <span class="hidden-xs-down">Desde Archivo Excel</span></a> </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active pt-2" id="manual" role="tabpanel">
                <div wire:loading wire:target="update">
                    <div class="loader">
                        <div class="loader__figure"></div>
                        <p class="loader__label" style="color: red;">La Mega Tienda Turén</p>
                    </div>
                    <div>
                        <br><br><br><br><br><br><br>
                        <br><br><br><br><br><br><br>
                    </div>
                </div>
                <div wire:loading.remove wire:target="update">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-material mt-4 d-flex justify-content-center">
                                <div class="col-12 input-group">
                                    <select class="form-control mr-2" wire:model="category">
                                        <option><i class="icon-filter"></i> Filtrar por Categoría</option>
                                        @foreach($categories as $c)
                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach    
                                    </select>    
                                
                                    <input type="text" id="search_box" wire:model="ssearch" class="form-control" placeholder="Buscar &hellip;" />
                                </div> 
                            </div>
                            @if(count($ssproducts) > 0)
                            <ul class="list-group mt-4 list-group-flush">
                                @error('sprice')
                                <div class="alert alert-danger"> <i class="ti-alert"></i> {{$message}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                </div> 
                                @enderror

                                @foreach($ssproducts as $p)
                                <li class="list-group-item">
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <label for="">Producto</label><br/>
                                            <span class="font-bold mt-3">{{$p->name}} {{$p->presentation->name}}{{$p->presentation->medida}}</span>
                                        </div>
                                        <div class="col-2 text-center">
                                            <label for="">Precio</label><br>
                                            <span class="font-bold mt-3">{{$p->price}}$</span>
                                        </div>
                                        <div class="col-2 text-center">
                                            <label for="">Precio Oferta</label><br>
                                            <span class="font-bold mt-3">{{$p->sale_price}}$</span>
                                        </div>
                                        <div class="col-3">
                                            <label for="">Actualizar Precio</label>
                                            <input type="number" wire:model.defer="sprice" class="form-control">
                                        </div>
                                        <div class="col-2 mt-4">
                                            <button wire:click.prevent="update({{$p->id}})" wire:loading.disabled wire:target="update"  class="mt-2 btn btn-info waves-effect waves-light">Actualizar</button>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <div class="float-right">
                                {{$ssproducts->onEachSide(5)->links()}}
                            </div>
                            @elseif($ssearch !== '')
                            <ul class="list-group mt-4 list-group-flush">
                                <li class="list-group-item">
                                    <span>No hay resultados para la busqueda: "{{$ssearch}}"</span>
                                </li>
                                
                            </ul>
                            @endif
                        </div>    
                    </div>    
                </div>
            </div>
            <div class="tab-pane pt-2" id="import" role="tabpanel">
                <form action="{{ route('admin.productimportoffer') }}" method="POST" enctype="multipart/form-data">
                    @csrf
        
                    <div class="form-group">
                        <label for="file_import" class="control-label">Seleccione un archivo Excel</label>
                        <input type="file" class="form-control" name="file_import">    
                            
                        @error('file_import')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                        
                    <div class="mt-4 d-flex justify-content-end form-group">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Actualizar Precios</button>
                    </div>
                </form> 
            </div>
            <div class="mt-4 d-flex justify-content-start form-group">
                <button wire:click="$set('views', 'update')" class="mt-2 btn btn-secondary waves-effect waves-light mr-2">Volver</button>
            </div>
        </div>
        </div>
    </div>            
    </div>          

</div>

@endif

@push('scripts')


<script type="text/javascript">
      
$('#liSale').addClass("active");

window.livewire.on('updateSales',()=>{
    $.toast({
        heading: 'Notificación',
        text: 'La configuración de las ofertas se actualizó con éxito.',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'success',
        hideAfter: 3500, 
        stack: 6
    });
});

window.livewire.on('addSales',()=>{
    $.toast({
        heading: 'Notificación',
        text: 'La configuración de las ofertas se actualizó con éxito.',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'success',
        hideAfter: 3500, 
        stack: 6
    });
});

window.livewire.on('updateSalesOffer',()=>{
    $.toast({
        heading: 'Notificación',
        text: 'Los precios se han restablecido con éxito.',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'success',
        hideAfter: 3500, 
        stack: 6
    });
});

@if (session('info_p'))
    $('#create-modal').modal('hide');
    $.toast({
        heading: 'Notificación',
        text: '{{session('info_p')}}',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'success',
        hideAfter: 3500, 
        stack: 6
    }); 
@endif

$(function(){
    $('#sale-date').datetimepicker({
        format: 'DD-MM-Y h:m:s',
    }).on('dp.change',function(ev){
        var data = $('#sale-date').val();
        @this.set('sale_date',data);
    });
});        
</script>
@endpush