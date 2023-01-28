 <!-- sample modal content -->
 <div wire:ignore.self id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="create-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Editar Cuenta Bancaria</h4>
                <button type="button" wire:click="$emit('render')" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                
                <div wire:loading>
                    <div class="loader">
                        <div>
                           <img class="animate-pulse" width="80" height="60" src="{{ asset('dist/new/img/logos/logo-meka.svg') }}" alt="Inversiones Meka">
                        </div>    
                    </div>
                    <div>
                        <br><br><br><br><br><br><br><br><br>
                    </div>
                </div>
                <div wire:loading.remove>
                    <div class="flex">
                        <div class="form-group flex-1">
                            <label for="type_d" class="control-label">Tipo de Documento</label>
                            <select class="form-control" wire:model.defer="type_d">
                                <option value="0">Seleccione</option>
                                <option @if ($type_d ="V") selected @endif value="V">V</option>
                                <option @if ($type_d ="J") selected @endif value="J">J</option>
                                <option @if ($type_d ="E") selected @endif value="E">E</option>
                            </select>    
                            @error('type_d')
                                <small class="text-danger">{{$message}}</small>   
                            @enderror
                        </div>
                        <div class="form-group flex-2">
                            <label for="cedula" class="control-label">Cédula/RIF/Pasaporte</label>
                            <input type="number" class="form-control" wire:model.defer="cedula" min="1" placeholder="Ingrese la Cédula, RIF o Pasaporte">    
                
                            @error('cedula')
                                <small class="text-danger">{{$message}}</small>   
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type_account" class="control-label">Tipo de Cuenta</label>
                        <select class="form-control" wire:model.defer="type_account">
                            <option value="0">Seleccione</option>
                            <option @if ($type_account ="Corriente") selected @endif value="Corriente">Corriente</option>
                            <option @if ($type_account ="Ahorro") selected @endif value="Ahorro">Ahorro</option>
                            <option @if ($type_account ="Jurídica") selected @endif value="Jurídica">Jurídica</option>
                        </select>    
                        @error('type_account')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="bank_id" class="control-label">Banco</label>
                        <select class="form-control" wire:model.defer="bank_id">
                            <option value="0">Seleccione</option>
                            @foreach ($banks as $b)
                                @if ($b->id == $bank_id)
                                    <option selected value="{{$b->id}}">({{$b->code}}) {{$b->name}}</option>    
                                @else
                                <option value="{{$b->id}}">({{$b->code}}) {{$b->name}}</option> 
                                @endif
                            @endforeach
                        </select>    
                        @error('bank_id')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="account" class="control-label">Nro. de Cuenta</label>
                        <input type="number" class="form-control" wire:model.defer="account" min="20" placeholder="Ingrese el Nro. de Cuenta">    
            
                        @error('account')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="beneficiary" class="control-label">Beneficiario</label>
                        <input type="text" class="form-control" wire:model.defer="beneficiary" placeholder="Ingrese el Nombre del Beneficiario">    
            
                        @error('beneficiary')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone" class="control-label">Teléfono</label>
                        <input type="number" class="form-control" wire:model.defer="phone" min="1" placeholder="Ingrese el Nro de Teléfono">    
            
                        @error('phone')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pm" class="control-label">Pago Móvil</label>
                        <select class="form-control" wire:model.defer="pm">
                            <option value="0">Seleccione</option>
                            <option @if ($pm ="si") selected @endif value="si">Si</option>
                            <option @if ($pm ="no") selected @endif value="no">No</option>
                        </select>    

                        @error('pm')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" wire:click="$emit('render')" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        <button wire:click.prevent="update()" wire:loading.remove wire:target="update" class="btn btn-info waves-effect waves-light">Guardar</button>
                        <button wire:loading wire:target="update" class="btn btn-info waves-effect waves-light">Cargando...</button>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
