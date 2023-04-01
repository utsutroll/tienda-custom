 <!-- sample modal content -->
 <div wire:ignore.self id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="create-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Editar Categoría</h4>
                <button type="button" wire:click="$emit('render')" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                
                <div wire:loading>
                    <div class="loader">
                        <div>
                           <img class="animate-pulse" width="80" height="60" src="{{ asset('dist/new/img/logos/logo-meka.png') }}" alt="Inversiones Meka">
                        </div>    
                    </div>
                    <div>
                        <br><br><br><br><br><br><br><br><br><br><br><br>
                    </div>
                </div>
                <div wire:loading.remove>
                    <div class="form-group">
                        <label for="categoria" class="control-label">Categoría</label>
                        <input type="text" class="form-control" wire:model.defer="name" placeholder="Ingrese el Nombre de la Categoría">    
                
                        @error('name')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        @if ($image != $oldimage)
                            <div class="image-wrapper d-flex justify-content-center">
                                <img src="{{ $image->temporaryUrl() }}">
                            </div>
                        @else
                            <div class="image-wrapper d-flex justify-content-center">
                                <img id="picture" src="{{Storage::url($image)}}">
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="file" wire:model.defer="image" class="file form-control" accept="image/*"/>

                        @error('image')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" wire:click="$emit('render')" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        <button wire:click.prevent="update()" wire:loading.remove wire:target="update" class="btn btn-info waves-effect waves-light">Editar Categoría</button>
                        <button wire:loading wire:target="update" class="btn btn-info waves-effect waves-light">Cargando...</button>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
