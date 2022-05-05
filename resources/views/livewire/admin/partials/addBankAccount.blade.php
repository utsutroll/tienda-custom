 <!-- sample modal content -->
 <div wire:ignore.self id="create-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="create-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Nueva Cuenta Bancaria</h4>
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
                    <div class="flex">
                        <div class="form-group flex-1">
                            <label for="type_d" class="control-label">Tipo de Documento</label>
                            <select id="type_d" class="form-control" wire:model.defer="type_d">
                                <option value="0">Seleccione</option>
                                <option value="V">V</option>
                                <option value="J">J</option>
                                <option value="E">E</option>
                            </select>    
                            @error('type_d')
                                <small class="text-danger">{{$message}}</small>   
                            @enderror
                        </div>
                        <div class="form-group flex-2">
                            <label for="cedula" class="control-label">Cédula/RIF/Pasaporte</label>
                            <input type="number" id="cedula" class="form-control" min="1" wire:model.defer="cedula" placeholder="Ingrese la Cédula, RIF o Pasaporte">    
                
                            @error('cedula')
                                <small class="text-danger">{{$message}}</small>   
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type_account" class="control-label">Tipo de Cuenta</label>
                        <select id="type_account" class="form-control" wire:model.defer="type_account">
                            <option value="0">Seleccione</option>
                            <option value="Corriente">Corriente</option>
                            <option value="Ahorro">Ahorro</option>
                            <option value="Júridica">Jurídica</option>
                        </select>    
                        @error('type_account')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="bank_id" class="control-label">Banco</label>
                        <select id="bank_id" class="form-control" wire:model.defer="bank_id">
                            <option value="0">Seleccione</option>
                            @foreach ($banks as $b)
                            <option value="{{$b->id}}">({{$b->code}}) {{$b->name}}</option>    
                            @endforeach
                        </select>    
                        @error('bank_id')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="account" class="control-label">Nro. de Cuenta</label>
                        <input type="number" id="account" class="form-control" min="20" wire:model.defer="account" placeholder="Ingrese el Nro. de Cuenta">    
            
                        @error('account')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="beneficiary" class="control-label">Beneficiario</label>
                        <input type="text" id="beneficiary" class="form-control" wire:model.defer="beneficiary" placeholder="Ingrese el Nombre del Beneficiario">    
            
                        @error('beneficiary')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone" class="control-label">Teléfono</label>
                        <input type="number" id="phone" class="form-control" min="1" wire:model.defer="phone" placeholder="Ingrese el Nro de Teléfono">    
            
                        @error('phone')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pm" class="control-label">Pago Móvil</label>
                        <select id="pm" class="form-control" wire:model.defer="pm">
                            <option value="0">Seleccione</option>
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
                        
                        @error('pm')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        <button wire:click.prevent="save()" wire:loading.remove wire:target="save" class="btn btn-success waves-effect waves-light">Registrar</button>
                        <button wire:loading wire:target="save" class="btn btn-info waves-effect waves-light">Cargando...</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
