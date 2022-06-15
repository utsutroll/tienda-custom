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
                    <li class="breadcrumb-item"><a href="{{ route('admin.sale') }}">Listado de Productos en oferta</a></li>
                    <li class="breadcrumb-item active">Configurar Ofertas</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="d-flex justify-content-end align-items-end m-b-15">
        <a href="{{ route('admin.sale-price') }}" class="btn btn-success btn-md">Precios de oferta</a>
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
                            <a href="{{ route('admin.sale') }}" class="mt-2 btn btn-secondary waves-effect waves-light mr-4">Volver</a>
                            <button type="submit" class="mt-2 btn btn-info waves-effect waves-light">Actualizar</button>
                        </div>
                    </form> 
                </div>  
            </div>
        </div>          
    </div>
</div>
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