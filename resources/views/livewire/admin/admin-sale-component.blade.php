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
                <div wire:loading wire:target="update">
                    <div class="loader">
                        <div>
                           <img class="animate-pulse" width="80" height="60" src="{{ asset('dist/new/img/logos/logo-meka.svg') }}" alt="Inversiones Meka">
                        </div>    
                    </div>
                    <div>
                        <br><br><br><br><br><br><br>
                        <br><br><br><br><br><br><br>
                    </div>
                </div>
                <div wire:loading.remove wire:target="update">
                    <div class="row mt-4 d-flex justify-content-center">
                        <div wire:ignore class="col-5">
                            <select wire:model="producto" class="select_pro" style="width:100%;">
                                <option value="0">Selecione</option>
                                @foreach($ssproducts as $p)
                                <option value="{{ $p->id }}">{{$p->product->name}} {{$p->product->brand->name}} {{$p->characteristic->name}} </option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ml-2">
                            <button wire:click.prevent="buscar()" class="btn btn-info btn-small">Buscar</button>
                        </div>
                    </div>
                    @error('price')
                        <div class="alert alert-danger"> <i class="ti-alert"></i> {{$message}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        </div> 
                    @enderror
                    <ul class="list-group mt-4 list-group-flush">
                        <li class="list-group-item">
                            <div class="form-group row">
                                <div class="col-5">
                                    <label for="">Producto</label><br/>
                                    <span class="font-bold mt-3">{{ $nombre }}</span>
                                </div>
                                <div class="col-3 text-center"> 
                                    <label for="">Precio actual</label><br>
                                    <span class="font-bold mt-3">{{ $precio }}$</span>
                                </div>
                                <div class="col-2">
                                    <label for="">Precio Nuevo</label>
                                    <input type="number" wire:model.defer="price" class="form-control">
                                </div>
                                <div class="col-2 mt-4">
                                    <button wire:click.prevent="update({{ $product_id }})" wire:loading.disabled wire:target="update"  class="mt-2 btn btn-info waves-effect waves-light">Actualizar</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-4 d-flex justify-content-start form-group">
                <button wire:click="$set('views', 'update')" class="mt-2 btn btn-secondary waves-effect waves-light mr-2">Volver</button>
            </div>
        </div>
    </div>          
</div>

@endif

@push('scripts')

<script type="text/javascript">
    
$('#liSale').addClass("active");
$('.select_pro').select2();

$('.select_pro').on('change', function (e) {
 
    var data = $('.select_pro').val();

    @this.set('producto', data);

});

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