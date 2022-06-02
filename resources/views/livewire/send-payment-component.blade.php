<div class="p-2 md:p-4 lg:p-4 m-4 md:m-8 lg:m-8">
    <div class="bg-slate-200 rounded-md shadow-lg shadow-black">
        <div class="p-2 md:p-4 lg:p-4">
            <h5 class="mb-2 text-center text-2xl font-semibold font-sans">Enviar datos del pago.</h5>
            <hr/>
            <form wire:submit.prevent="sendPayment">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                <div class="cols-1 md:cols-2 lg:cols-2">
                    <h5 class="my-4 ml-2 text-md font-semibold font-sans">Elige una opción de pago<span style="color:red;">*</h5>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
                            <div class="custom-control custom-radio cols-1">
                                <input type="radio" id="moneys" wire:model="paymentmode" value="money" class="custom-control-input">
                                <label class="custom-control-label" for="moneys">Efectivo</label>
                            </div>
                            <div class="custom-control custom-radio cols-1">
                                <input type="radio" id="banks" wire:model="paymentmode" value="bank" class="custom-control-input">
                                <label class="custom-control-label" for="banks">Cuentas Bancarias</label>
                            </div>
                            <div class="custom-control custom-radio cols-1">
                                <input type="radio" id="wallets" wire:model="paymentmode" value="wallet" class="custom-control-input">
                                <label class="custom-control-label" for="wallets">Billeteras Electrónicas</label>
                            </div>
                        </div>
                            <hr/>
                            @if ($paymentmode == "money")
                            <div class="">        
                                <div class="">
                                    <p><span class="my-2 text-base font-medium text-gray-700 font-sans">Nota:</span> Al eliegir este método de pago también podrá pagar diferencia por punto de venta si así lo desea</p>
                                </div>
                                <div class="custom-control custom-checkbox my-2">
                                    <input type="checkbox" id="customCheck1" wire:model.defer="bank_id" value="money" @if($paymentmode == "money") required @endif class="custom-control-input">
                                    <label class="custom-control-label" for="customCheck1">Selecciona si Usaste este metodo de Pago<span style="color:red;">*</span></label>
                                </div>  
                            </div>
                            @elseif($paymentmode == "bank")
                                @if (count($banks) > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                                    @foreach ($banks as $b)
                                        @if ($b->pm == "si")
                                            <div class="cols-1 md:cols-1 lg:cols-1">
                                                <h4 class="text-xl font-semibold font-sans my-4">Transferencias</h4>
                                                <p><span class="mb-1 text-base font-semibold text-gray-700">Banco:</span> {{ $b->bank->name }}</p>
                                                <p><span class="mb-1 text-base font-semibold text-gray-700">Beneficiario:</span> {{ $b->beneficiary }}</p>
                                                <p><span class="mb-1 text-base font-semibold text-gray-700">Cedula:</span> {{ $b->type_d }}-{{ $b->cedula }}</p>
                                                <p><span class="mb-1 text-base font-semibold text-gray-700">Nro. de Cuenta:</span> {{ $b->account }}</p>
                                                <p><span class="mb-1 text-base font-semibold text-gray-700">Tipo de Cuenta:</span> {{ $b->type_account }}</p>
                                            </div>
                                            <div class="cols-1 md:cols-1 lg:cols-1">
                                                <h4 class="text-xl font-semibold font-sans my-4">Pago Móvil</h4>
                                                <p><span class="mb-1 text-base font-semibold text-gray-700">Banco:</span> ({{ $b->bank->code }}) {{ $b->bank->name }}</p>
                                                <p><span class="mb-1 text-base font-semibold text-gray-700">Cedula:</span> {{ $b->type_d }}-{{ $b->cedula }}</p>
                                                <p><span class="mb-1 text-base font-semibold text-gray-700">Teléfono:</span> {{ $b->phone }}</p>
                                            </div>
                                        @else
                                        <div class="cols-1 md:cols-1 lg:cols-1">
                                            <h4 class="text-xl font-semibold font-sans my-4">Transferencias</h4>
                                            <p><span class="mb-1 text-base font-semibold text-gray-700">Banco:</span> ({{ $b->bank->code }}) {{ $b->bank->name }}</p>
                                            <p><span class="mb-1 text-base font-semibold text-gray-700">Beneficiario:</span> {{ $b->beneficiary }}</p>
                                            <p><span class="mb-1 text-base font-semibold text-gray-700">Cedula:</span> {{ $b->tipo_d }}-{{ $b->cedula }}</p>
                                            <p><span class="mb-1 text-base font-semibold text-gray-700">Nro. de Cuenta:</span> {{ $b->account }}</p>
                                            <p><span class="mb-1 text-base font-semibold text-gray-700">Tipo de Cuenta:</span> {{ $b->type_account }}</p>
                                        </div>
                                        @endif          
                                    @endforeach 
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="customCheck1" wire:model.defer="bank_id" value="{{ $b->id }}" @if($paymentmode == "bank") required @endif class="custom-control-input">
                                        <label class="custom-control-label" for="customCheck1">Selecciona si Usaste este metodo de Pago<span style="color:red;">*</span></label>
                                    </div> 
                                </div>
                                <hr/>     
                                @else
                                <h1 class="my-4 text-lg font-medium text-gray-700 font-sans">No hay método de pago agregado</h1>   
                                @endif
                                
                            @elseif($paymentmode == "wallet")
                                @if (count($wallets) > 0)
                                    <div class="cols-1 md:cols-2 lg:cols-2">
                                        @foreach ($wallets as $w)
                                            <h4 class="text-xl font-semibold font-sans mt-4">Información general</h4>
                                            <p><span class="mb-1 text-base font-semibold text-gray-700">Plataforma:</span> {{ $w->name }}</p>
                                            @if ($w->type == "crypto")
                                                <p><span class="mb-1 text-base font-semibold text-gray-700">Billetera:</span> {{ $w->wallet_email }}</p>       
                                            @else
                                                <p><span class="mb-1 text-base font-semibold text-gray-700">Correo Electrónico:</span> {{ $w->wallet_email }}</p>    
                                            @endif
                                            <hr/>
                                        @endforeach
                                        <div class="custom-control custom-checkbox cols-2">
                                            <input type="checkbox" id="customCheck2" wire:model.defer="wallet_id" value="{{ $w->id }}" @if($paymentmode == "wallet") required @endif class="custom-control-input">
                                            <label class="custom-control-label" for="customCheck2">Selecciona si Usaste este metodo de Pago<span style="color:red;">*</span></label>
                                        </div>
                                    </div>
                                @else
                                    <h1 class="text-base font-semibold text-gray-700 font-sans">No hay método de pago agregado</h1>    
                                @endif
                            @endif
                </div>
                @if ($paymentmode != "money")
                <div class="cols-1 md:cols-2 lg:cols-2">
                    <hr class="md:hidden lg:hidden">
                    <h5 class="my-2 text-center text-lg font-semibold font-sans">Proporcione la Información Solicitada</h5>
                    <div class="p-4">
                        <div class="m-2">
                            <div class="my-2">
                                <label for="captura" class="font-sans font-semibold text-gray-700">Agregue la Captura de la Trasnferencia o Pago Móvil (Opcional)</label>
                                <input type="file" name="captura" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md" accept='image/*' wire:model.defer="captura" placeholder="Seleccione Una Imagen"/>
                            </div>
                            <div class="my-4">
                                <label for="referencia" class="font-sans font-semibold text-gray-700">Nro. de Referencia<span style="color:red;">*</span></label>
                                <input type="number" name="referencia" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md" wire:model.defer="referencia" min="1" placeholder="Ingrese el Nro. Referencia" >
                                @error('referencia')
                                    <small class=text-red-600">{{$message}}</small>   
                                @enderror
                            </div>
                        </div> 
                    </div>
                </div>
                @endif
            </div>
            @if (Session::has('checkout'))
            <div class="flex justify-end my-4">
                <h1 class="text-base font-bold font-sans text-gray-800">Total a Pagar: {{Session::get('checkout')['total']}}$ ~ @foreach ($dollar as $d){{number_format(round(($d->price*Session::get('checkout')['total']),2),2)}} <input type="number" hidden name="price_bs" wire:model.defer="price_bs" value="{{round($d->price*Session::get('checkout')['total']),2}}"> @endforeach Bs</h1>
            </div>    
            @endif
            
            <hr/>
            <div class="flex justify-end my-2">
                <button wire:click.prevent="cancelPayment" class="p-2 mr-2 text-base text-white font-semibold rounded-md bg-red-700 hover:bg-red-900 shadow-lg shadow-red-600">Cancelar</button>
                <button type="submit" class="p-2 mr-2 text-base text-white font-semibold rounded-md bg-teal-600 hover:bg-teal-800 shadow-lg shadow-teal-600">Comprobar</button>
            </div>
            </form>
        </div>
    </div>
</div>