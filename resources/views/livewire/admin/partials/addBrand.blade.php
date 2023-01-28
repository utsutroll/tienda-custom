 <!-- sample modal content -->
 <div wire:ignore.self id="create-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="create-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Nueva Marca</h4>
                <button type="button" wire:click="$emit('render')" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div wire:loading wire:target="create">
                    <div class="loader">
                        <div>
                           <img class="animate-pulse" width="80" height="60" src="{{ asset('dist/new/img/logos/logo-meka.svg') }}" alt="Inversiones Meka">
                        </div>    
                    </div>
                    <div>
                        <br><br><br><br><br><br><br><br><br>
                    </div>
                </div>
                <div wire:loading.remove wire:target="create">
                    <div class="form-group">
                        <label for="marca" class="control-label">Marca</label>
                        <input type="text" class="form-control" min="1" wire:model.defer="name" placeholder="Ingrese la Marca">    
            
                        @error('name')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
            
                    <div class="modal-footer">
                        <button type="button" wire:click="$emit('render')" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        <button wire:click.prevent="save()" wire:loading.remove wire:target="save" class="btn btn-success waves-effect waves-light">Crear Marca</button>
                        <button wire:loading wire:target="save" class="btn btn-info waves-effect waves-light">Cargando...</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
