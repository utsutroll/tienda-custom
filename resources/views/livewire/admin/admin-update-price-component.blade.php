<div wire:ignore.self class="modal fade" id="modalUpdatePrice" role="dialog" aria-labelledby="modalUpdatePrice" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"> 
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white font-bold" id="modalUpdatePrice">Actualización de precio general del Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div wire:loading wire:target="update">
                    <div class="loader">
                        <div>
                           <img class="animate-pulse" width="80" height="60" src="{{ asset('dist/new/img/logos/logo-meka.png') }}" alt="Inversiones Meka">
                        </div>    
                    </div>
                    <div>
                        <br><br><br><br><br><br><br>
                        <br><br><br><br><br><br><br>
                    </div>
                </div>
                <div wire:loading.remove wire:target="update">

                    <div class="pt-2">
                        <div class="form-material mt-4 d-flex justify-content-center">
                            <div class="col-10 form-group"> 
                                <input type="text" wire:model="search_pro" class="form-control" placeholder="Buscar por código ó nombre del producto &hellip;" />
                            </div> 
                        </div>
                        
                        @if(count($productss) > 0)
                        <ul class="list-group mt-4 list-group-flush">
                            @error('prices')
                            <div class="alert alert-danger"> <i class="ti-alert"></i> {{$message}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                            </div> 
                            @enderror

                            @foreach($productss as $pp)
                            
                            <li class="list-group-item">
                                <div class="form-group row">
                                    <div class="col-3">
                                        <label for="">Producto</label><br/>
                                        <span class="font-bold mt-3">{{$pp->name}} {{$pp->brand->name}} </span>
                                    </div>
                                    <div class="col-3 text-center"> 
                                        <label for="">Precio actual</label><br>
                                        <span class="font-bold mt-3">{{$pp->price}}$</span>
                                    </div>
                                    <div class="col-4">
                                        <label for="">Actualizar Precio</label>
                                        <input type="number" wire:model.defer="prices" class="form-control">
                                    </div>
                                    <div class="col-2 mt-4">
                                        <button wire:click.prevent="actualizar('{{$pp->slug}}')" wire:loading.disabled wire:target="actualizar"  class="mt-2 btn btn-info waves-effect waves-light">Actualizar</button>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="float-right">
                            {{$productss->onEachSide(5)->links()}}
                        </div>
                        @elseif($search_pro !== '')
                        <ul class="list-group mt-4 list-group-flush">
                            <li class="list-group-item">
                                <span>No hay resultados para la busqueda: "{{$search_pro}}"</span>
                            </li>
                            
                        </ul>
                        @endif     
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('.select_pro').select2();

        $('.select_pro').on('change', function (e) {
 
        var data = $('.select_pro').val();

        @this.set('producto', data);

        });
    </script>
@endpush