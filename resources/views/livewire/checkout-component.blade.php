<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Datos de la Persona que Retirará el pedido</h5>
                    <hr/>
                    <form wire:submit.prevent="placeOrder">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre<span style="color:red;">*</span></label>
                                <input type="text" name="firstname" wire:model.defer="firstname" class="form-control" placeholder="Su Nombre">
                                @error('firstname')
                                    <small class="text-danger">{{$message}}</small>   
                                @enderror
                            </div>   

                            <div class="form-group">
                                <label for="">Cédula<span style="color:red;">*</span></label>
                                <input type="number" name="cedula" wire:model.defer="cedula" min="1" class="form-control" placeholder="Ingrese el número de la Cédula">
                                @error('cedula')
                                    <small class="text-danger">{{$message}}</small>   
                                @enderror
                            </div>  
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Apellido<span style="color:red;">*</span></label>
                                <input type="text" name="lastname" wire:model.defer="lastname" class="form-control" placeholder="Su Apellido">
                                @error('lastname')
                                    <small class="text-danger">{{$message}}</small>   
                                @enderror
                            </div> 

                            <div class="form-group">
                                <label for="">Número de Teléfono<span style="color:red;">*</span></label>
                                <input type="number" name="mobile" wire:model.defer="mobile" min="1" class="form-control" placeholder="Ejem.(4121234567)">
                                @error('mobile')
                                    <small class="text-danger">{{$message}}</small>   
                                @enderror
                            </div>  
                        </div>
                    </div>
                    <hr/>
                    @if(Auth::user()->utype == "USR")
                    <div class="form-group d-flex justify-content-end">
                        <button wire:click.prevent="cancelCheckout" class="btn btn-danger mr-2">Cancelar</button>
                        <button type="submit" class="btn btn-success">Comprobar</button>
                    </div>
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
