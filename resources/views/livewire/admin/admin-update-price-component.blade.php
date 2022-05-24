<div wire:ignore.self class="modal fade" id="modalUpdatePrice" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePrice" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white font-bold" id="modalUpdatePrice">Actualización de Precio del Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#manual" role="tab"><span class="hidden-sm-up"><i class="ti-hand-open"></i></span> <span class="hidden-xs-down">Manual</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#import" role="tab"><span class="hidden-sm-up"><i class="ti-import"></i></span> <span class="hidden-xs-down">Desde Archivo Excel</span></a> </li>
                </ul>
                            <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active pt-2" id="manual" role="tabpanel">
                        <div class="form-material mt-4 d-flex justify-content-center">
                            <div class="col-10 form-group"> 
                                <input type="text" id="search_box" wire:model="search" class="form-control" placeholder="Buscar &hellip;" />
                            </div> 
                        </div>
                        
                        @if(count($products) > 0)
                        <ul class="list-group mt-4 list-group-flush">
                            @error('price')
                            <div class="alert alert-danger"> <i class="ti-alert"></i> {{$message}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                            </div> 
                            @enderror

                            @foreach($products as $p)
                            
                            <li class="list-group-item">
                                <div class="form-group row">
                                    <div class="col-3">
                                        <label for="">Producto</label><br/>
                                        <span class="font-bold mt-3">{{$p->product->name}} {{$p->product->presentation->name}} {{$p->product->brand->name}} {{$p->characteristic->name}}</span>
                                    </div>
                                    <div class="col-3 text-center"> 
                                        <label for="">Precio actual</label><br>
                                        <span class="font-bold mt-3">{{$p->price}}$</span>
                                    </div>
                                    <div class="col-4">
                                        <label for="">Actualizar Precio</label>
                                        <input type="number" wire:model.defer="price" class="form-control">
                                    </div>
                                    <div class="col-2 mt-4">
                                        <button wire:click.prevent="update({{$p->id}})" wire:loading.disabled wire:target="update"  class="mt-2 btn btn-info waves-effect waves-light">Actualizar</button>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="float-right">
                            {{$products->onEachSide(5)->links()}}
                        </div>
                        @elseif($search !== '')
                        <ul class="list-group mt-4 list-group-flush">
                            <li class="list-group-item">
                                <span>No hay resultados para la busqueda: "{{$search}}"</span>
                            </li>
                            
                        </ul>
                        @endif
                    </div>
                    <div class="tab-pane pt-2" id="import" role="tabpanel">
                        <h5 class="card-title p-2 mb-2">Actualizar precios de los productos desde un archivo Excel</h5>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <form action="{{ route('admin.productimport') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Seleccione el Archivo Excel</label>
                                        <input type="file" name="file" required class="form-control">
                                    </div>
                                    <div class="mt-4 d-flex justify-content-end">
                                        <button type="submit" class="mt-2 btn btn-info waves-effect waves-light">Actualizar Precios</button>
                                    </div>
                                </form> 
                            </div>
                        </div>
                             
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

