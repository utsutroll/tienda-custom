 <!-- sample modal content -->
 <div wire:ignore.self id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="create-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Editar Usuario</h4>
                <button type="button" class="close" wire:click="$emit('render')" data-dismiss="modal" aria-hidden="true">×</button>
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
                    <div class="form-group">
                        <label for="name" class="control-label">Nombre</label>
                        <input type="text" class="form-control" wire:model.defer="name" placeholder="Ingrese el Nombre del Usuario">    
            
                        @error('name')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="control-label">Nombre</label>
                        <input type="text" class="form-control" wire:model.defer="lastname" placeholder="Ingrese el Apellido del Usuario">    
            
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
                    <div class="form-group">
                        <label for="document" class="control-label">Documento</label>   
                        <select id="document" class="form-control" wire:model.defer="document" :value="old('document')">
                            <option value="CÉDULA DE IDENTIDAD">CÉDULA DE IDENTIDAD</option>
                            <option value=" CÉDULA DE EXTRANJERÍA">CÉDULA DE EXTRANJERÍA</option>
                            <option value="RIF PERSONA JURÍDICA">RIF PERSONA JURÍDICA</option>
                            <option value="RIF PERSONA NATURAL">RIF PERSONA NATURAL</option>
                            <option value="RIF-V">RIF-V</option>
                            <option value="RIF-E">RIF-E</option>
                            <option value="RIF-G">RIF-G</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                        </select>
                        @error('document')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="document_number" class="control-label">Número de Documento</label>
                        <input type="number" class="form-control" wire:model.defer="document_number" placeholder="Ingrese el Número de Documento" :value="old('document_number')">    
            
                        @error('document_number')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sexo" class="control-label">Sexo</label>   
                        <select id="sexo" class="form-control" wire:model.defer="sexo" :value="old('sexo')">
                            <option value="">Seleccione</option>
                            <option value="Hombre">Hombre</option>
                            <option value="Mujer">Mujer</option>
                        </select>
                        @error('sexo')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" wire:click="$emit('render')" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                        <button wire:click.prevent="update()" wire:loading.remove wire:target="update" class="btn btn-info waves-effect waves-light">Editar Usuario</button>
                        <button wire:loading wire:target="update" class="btn btn-info waves-effect waves-light">Cargando...</button>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
