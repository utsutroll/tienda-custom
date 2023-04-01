 <!-- sample modal content -->
 <div wire:ignore.self id="edit-modal" class="modal fade" role="dialog" aria-labelledby="edit-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Editar Subcategoría</h4>
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
                        <label for="subcategory" class="control-label">Subcategoría</label>
                        <input type="text" class="form-control" min="1" wire:model.defer="name" placeholder="Ingrese la Subcategoría">    
            
                        @error('name')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category" class="control-label">Categoría</label>
                        <select class="form-control" wire:model.defer="category_id" style="width: 100%;">
                            <option value="0">Seleccione</option>
                            @foreach ($categories as $c)
                                @if($category_id == $c->id)
                                <option selected value="{{ $c->id }}">{{ $c->name }}</option>
                                @else
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endif   
                            @endforeach
                        </select>

                        @error('category_id')
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
                        <input type="file" wire:model.defer="image" id="file" class="form-control" accept="image/*"/>

                        @error('image')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
            
                    <div class="modal-footer">
                        <button type="button" wire:click="$emit('render')" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        <button wire:click.prevent="update()" wire:loading.remove wire:target="update" class="btn btn-info waves-effect waves-light">Editar Subcategoría</button>
                        <button wire:loading wire:target="update" class="btn btn-info waves-effect waves-light">Cargando...</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
