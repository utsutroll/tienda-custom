<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Enviar datos del pago.</h5>
                    <hr/>
                    <form wire:submit.prevent="sendPayment">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="card-title">Elige una opción de pago<span style="color:red;">*</h5>
                            <div class="flex">
                                <div class="custom-control custom-radio flex-1">
                                    <input type="radio" id="moneys" wire:model="paymentmode" value="money" class="custom-control-input">
                                    <label class="custom-control-label" for="moneys">Efectivo</label>
                                </div>
                                <div class="custom-control custom-radio flex-1">
                                    <input type="radio" id="banks" wire:model="paymentmode" value="bank" class="custom-control-input">
                                    <label class="custom-control-label" for="banks">Cuentas Bancarias</label>
                                </div>
                                <div class="custom-control custom-radio flex-1">
                                    <input type="radio" id="wallets" wire:model="paymentmode" value="wallet" class="custom-control-input">
                                    <label class="custom-control-label" for="wallets">Billeteras Electrónicas</label>
                                </div>
                            </div>
                            <hr/>
                            @if ($paymentmode == "money")
                            <div class="">        
                                <div class="">
                                    <p><span class="text-base font-medium text-gray-700">Nota:</span> Al eliegir este método de pago también podrá pagar diferencia por punto de venta si así lo desea</p>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customCheck1" wire:model.defer="bank_id" value="money" @if($paymentmode == "money") required @endif class="custom-control-input">
                                    <label class="custom-control-label" for="customCheck1">Selecciona si Usaste este metodo de Pago<span style="color:red;">*</span></label>
                                </div>  
                            </div>
                            @elseif($paymentmode == "bank")
                                @if (count($banks) > 0)
                                <div class="row">
                                    @foreach ($banks as $b)
                                        @if ($b->pm == "si")
                                            <div class="col-md-6">
                                                <h4 class="card-title m-t-30">Transferencias</h4>
                                                <p><span class="text-base font-medium text-gray-700">Banco:</span> {{ $b->bank->name }}</p>
                                                <p><span class="text-base font-medium text-gray-700">Beneficiario:</span> {{ $b->beneficiary }}</p>
                                                <p><span class="text-base font-medium text-gray-700">Cedula:</span> {{ $b->type_d }}-{{ $b->cedula }}</p>
                                                <p><span class="text-base font-medium text-gray-700">Nro. de Cuenta:</span> {{ $b->account }}</p>
                                                <p><span class="text-base font-medium text-gray-700">Tipo de Cuenta:</span> {{ $b->type_account }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="card-title m-t-30">Pago Móvil</h4>
                                                <p><span class="text-base font-medium text-gray-700">Banco:</span> ({{ $b->bank->code }}) {{ $b->bank->name }}</p>
                                                <p><span class="text-base font-medium text-gray-700">Cedula:</span> {{ $b->type_d }}-{{ $b->cedula }}</p>
                                                <p><span class="text-base font-medium text-gray-700">Teléfono:</span> {{ $b->phone }}</p>
                                            </div>
                                        @else
                                        <div class="col-md-6">
                                            <h4 class="card-title m-t-30">Transferencias</h4>
                                            <p><span class="text-base font-medium text-gray-700">Banco:</span> ({{ $b->bank->code }}) {{ $b->bank->name }}</p>
                                            <p><span class="text-base font-medium text-gray-700">Beneficiario:</span> {{ $b->beneficiary }}</p>
                                            <p><span class="text-base font-medium text-gray-700">Cedula:</span> {{ $b->tipo_d }}-{{ $b->cedula }}</p>
                                            <p><span class="text-base font-medium text-gray-700">Nro. de Cuenta:</span> {{ $b->account }}</p>
                                            <p><span class="text-base font-medium text-gray-700">Tipo de Cuenta:</span> {{ $b->type_account }}</p>
                                        </div>
                                        @endif          
                                    @endforeach 
                                    <div class="custom-control custom-checkbox flex-1">
                                        <input type="checkbox" id="customCheck1" wire:model.defer="bank_id" value="{{ $b->id }}" @if($paymentmode == "bank") required @endif class="custom-control-input">
                                        <label class="custom-control-label" for="customCheck1">Selecciona si Usaste este metodo de Pago<span style="color:red;">*</span></label>
                                    </div> 
                                    <hr/> 
                                </div>    
                                @else
                                <h1 class="text-base font-medium text-gray-700">No hay método de pago agregado</h1>   
                                @endif
                                
                            @elseif($paymentmode == "wallet")
                                @if (count($wallets) > 0)
                                    <div class="row">
                                        @foreach ($wallets as $w)
                                            <div class="col-md-6">
                                                <h4 class="card-title m-t-30">Información general</h4>
                                                <p><span class="text-base font-medium text-gray-700">Plataforma:</span> {{ $w->name }}</p>
                                                @if ($w->type == "crypto")
                                                <p><span class="text-base font-medium text-gray-700">Billetera:</span> {{ $w->wallet_email }}</p>       
                                                @else
                                                <p><span class="text-base font-medium text-gray-700">Correo Electrónico:</span> {{ $w->wallet_email }}</p>    
                                                @endif
   
                                            </div>
                                            <hr/>
                                        @endforeach
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" id="customCheck2" wire:model.defer="wallet_id" value="{{ $w->id }}" @if($paymentmode == "wallet") required @endif class="custom-control-input">
                                                <label class="custom-control-label" for="customCheck2">Selecciona si Usaste este metodo de Pago<span style="color:red;">*</span></label>
                                            </div>
                                    </div>
                                @else
                                    <h1 class="text-base font-medium text-gray-700">No hay método de pago agregado</h1>    
                                @endif
                            @endif
                        </div>
                        @if ($paymentmode != "money")
                        <div class="col-lg-6">
                            <hr class="d-md-none d-lg-none">
                            <h5 class="card-title">Proporcione la Información Solicitada</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="captura">Agregue la Captura de la Trasnferencia o Pago Móvil (Opcional)</label>
                                        <input type="file" name="captura" class="form-control" accept='image/*' wire:model.defer="captura" placeholder="Seleccione Una Imagen"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="referencia">Nro. de Referencia<span style="color:red;">*</span></label>
                                        <input type="number" name="referencia" class="form-control" wire:model.defer="referencia" min="1" placeholder="Ingrese el Nro. Referencia" >
                                        @error('referencia')
                                            <small class="text-danger">{{$message}}</small>   
                                        @enderror
                                    </div>
                                </div> 
                            </div>
                        </div>
                        @endif
                    </div>
                    @if (Session::has('checkout'))
                    <div class="form-group d-flex justify-content-end my-3">
                        <h1 class="text-base font-bold text-gray-800">Total a Pagar: {{Session::get('checkout')['total']}}$ ~ @foreach ($dollar as $d){{number_format(round(($d->price*Session::get('checkout')['total']),2),2)}} <input type="number" hidden name="price_bs" wire:model.defer="price_bs" value="{{round($d->price*Session::get('checkout')['total']),2}}"> @endforeach Bs</h1>
                    </div>    
                    @endif
                    
                    <hr/>
                    <div class="form-group d-flex justify-content-end">
                        <button wire:click.prevent="cancelPayment" class="btn btn-danger mr-2">Cancelar</button>
                        <button type="submit" class="btn btn-success">Comprobar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>