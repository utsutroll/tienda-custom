 <!-- sample modal content -->
 <div wire:ignore.self id="create-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="create-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Nuevo Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div wire:loading wire:target="create">
                    <div class="loader">
                        <div class="loader__figure"></div>
                        <p class="loader__label" style="color: red;">La Mega Tienda Turén</p>
                    </div>
                    <div>
                        <br><br><br><br><br><br><br>
                    </div>
                </div>
                <div wire:loading.remove wire:target="create">
                    <div class="form-group">
                        <label for="name" class="control-label">Nombre</label>
                        <input type="text" class="form-control" wire:model.defer="name" placeholder="Ingrese el Nombre y Apellido del Usuario">    
            
                        @error('name')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Correo</label>
                        <input type="text" class="form-control" wire:model.defer="email" placeholder="Ingrese el Correo">    
            
                        @error('email')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Contraseña</label>
                        <input type="password" class="form-control" wire:model.defer="password" placeholder="Ingrese la Contraseña">    
            
                        @error('password')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        <button wire:click.prevent="save()" wire:loading.remove wire:target="save" class="btn btn-success waves-effect waves-light">Crear Usuario</button>
                        <button wire:loading wire:target="save" class="btn btn-info waves-effect waves-light">Cargando...</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
