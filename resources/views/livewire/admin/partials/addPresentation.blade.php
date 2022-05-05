 <!-- sample modal content -->
 <div wire:ignore.self id="create-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="create-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Nueva Presentación</h4>
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
                        <label for="presentacion" class="control-label">Presentación</label>
                        <input type="number" class="form-control" min="1" wire:model.defer="name" placeholder="Ingrese el Volúmen de la Presentación (Ejem: 500)">    
            
                        @error('name')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="medida" class="control-label">Medida</label>
                        <select class="form-control" wire:model.defer="medida">
                            <option value="0">Seleccione</option>
                            <option value="Kg">Kg</option>
                            <option value="G">G</option>
                            <option value="L">L</option>
                            <option value="Ml">Ml</option>
                            <option value="Cm³">Cm³</option>
                            <option value="M">M</option>
                            <option value="Cm">Cm</option>
                        </select>    
                        @error('medida')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        <button wire:click.prevent="save()" wire:loading.remove wire:target="save" class="btn btn-success waves-effect waves-light">Crear Presentación</button>
                        <button wire:loading wire:target="save" class="btn btn-info waves-effect waves-light">Cargando...</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
