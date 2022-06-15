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
                    <li class="breadcrumb-item"><a href="{{ route('admin.sale') }}">Listado de Productos en oferta</a></li>
                    <li class="breadcrumb-item active">Actualizar Precios de Ofertas</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="d-flex justify-content-center row">
        <div class="card col-12 md-col-10 lg-col-10">
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
                    <div class="row mt-4 justify-content-md-center">
                        <div wire:ignore class="col-6 md-col-5 lg-col-5">
                            <select wire:model="product" class="select_sale" style="width:100%;">
                                <option value="0">Selecione</option>
                                @foreach($ssproducts as $p)
                                <option value="{{ $p->id }}">{{$p->product->name}} {{$p->product->brand->name}} {{$p->characteristic->name}} </option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-2">
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
                <a href="{{ route('admin.sale-open') }}" class="mt-2 btn btn-secondary waves-effect waves-light mr-2">Volver</a>
            </div>
        </div>
    </div>          
</div>

@push('scripts')

<script type="text/javascript">
    
    $('#liSale').addClass("active");

    $('.select_sale').select2();

    $('.select_sale').on('change', function (e) {
    
        var data = $('.select_sale').val();

        @this.set('product', data);

    });
</script>
@endpush
