 <!-- sample modal content -->
 <div wire:ignore.self id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="create-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Editar Presentación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                
                <div wire:loading>
                    <div class="loader">
                        <div class="loader__figure"></div>
                        <p class="loader__label" style="color: red;">La Mega Tienda Turén</p>
                    </div>
                    <div>
                        <br><br><br><br><br><br><br>
                    </div>
                </div>
                <div wire:loading.remove>
                    <div class="form-group">
                        <label for="presentacion" class="control-label">Presentación</label>
                        <input type="number" class="form-control" wire:model.defer="name" min="1" placeholder="Ingrese el Volúmen de la Presentación (Ejem: 500)">    
            
                        @error('name')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="medida" class="control-label">Medida</label>
                            
                        <select class="form-control" wire:model.defer="medida">
                            <option value="0">Seleccione</option>
                            <option @if ($medida ="Kg") selected
                                
                            @endif value="Kg">Kg</option>
                            <option @if ($medida ="G") selected
                                
                            @endif value="G">G</option>
                            <option @if ($medida ="L") selected
                                
                            @endif value="L">L</option>
                            <option @if ($medida ="Ml") selected
                                
                            @endif value="Ml">Ml</option>
                            <option @if ($medida ="Cm³") selected
                                
                            @endif value="Cm³">Cm³</option>
                            <option @if ($medida ="M") selected
                                
                            @endif value="M">M</option>
                            <option @if ($medida ="Cm") selected
                                
                            @endif value="Cm">Cm</option>
                        </select>    
                        @error('media')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        <button wire:click.prevent="update()" wire:loading.remove wire:target="update" class="btn btn-info waves-effect waves-light">Editar Presentación</button>
                        <button wire:loading wire:target="update" class="btn btn-info waves-effect waves-light">Cargando...</button>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
