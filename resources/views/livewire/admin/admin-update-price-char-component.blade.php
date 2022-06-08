<div wire:ignore.self class="modal fade" id="modalUpdatePriceChar" role="dialog" aria-labelledby="modalUpdatePriceChar" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white font-bold" id="modalUpdatePriceChar">Actualización de precio por característica del producto </h5>
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
                    <div class="pt-2">
                        <div class="row mt-4 d-flex justify-content-center">
                            <div wire:ignore class="col-5">
                                <select wire:model="producto" class="select_pro" style="width:100%;">
                                    <option value="0">Selecione</option>
                                    @foreach($products as $p)
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
