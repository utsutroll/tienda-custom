<div class="p-2 md:p-4 lg:p-4 m-4 md:m-8 lg:m-8">
    <main class="px-6 md:px-28 lg:px-28 space-y-6">
        <header class="m-y-6 text-center text-3xl font-sans font-bold">Complete su compra</header>
        <section class="font-sans p-4 space-y-4" alt="Metodo de pago">
            <h1 class="text-lg md:text-xl lg:text-xl font-bold leading-3">Seleccione el método de pago</h1>
            <div class="grid grid-cols-3 gap-4 md:gap-12 lg:gap-12">
                <div class="py-4 md:py-6 lg:py-6 px-2 md:px-8 lg:px-8 text-center border cursor-pointer @if ($paymentmode == "money") border-gray-800 bg-gray-200 shadow-sm @else border-gray-400 @endif" wire:click="$set('paymentmode', 'money')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 m-auto" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1); align-self:center;">
                        <path d="M21 4H3a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-1 11a3 3 0 0 0-3 3H7a3 3 0 0 0-3-3V9a3 3 0 0 0 3-3h10a3 3 0 0 0 3 3v6z"></path><path d="M12 8c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path>
                    </svg>
                    <span>Efectivo</span> 
                </div>
                <div class="py-4 md:py-6 lg:py-6 px-2 md:px-8 lg:px-8 text-center border cursor-pointer @if ($paymentmode == "bank") border-gray-800 bg-gray-200 shadow-sm @else border-gray-400 @endif"" wire:click="$set('paymentmode', 'bank')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 m-auto" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1); align-self:center;">
                        <path d="M2 8v4.001h1V18H2v3h16l3 .001V21h1v-3h-1v-5.999h1V8L12 2 2 8zm4 10v-5.999h2V18H6zm5 0v-5.999h2V18h-2zm7 0h-2v-5.999h2V18zM14 8a2 2 0 1 1-4.001-.001A2 2 0 0 1 14 8z"></path>
                    </svg>
                    <span>Bancos</span> 
                </div>
                <div class="py-4 md:py-6 lg:py-6 px-2 md:px-8 lg:px-8 text-center border cursor-pointer @if ($paymentmode == "wallet") border-gray-800 bg-gray-200 shadow-sm @else border-gray-400 @endif"" wire:click="$set('paymentmode', 'wallet')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 m-auto" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1); align-self:center;">
                        <path d="M20 7V5c0-1.103-.897-2-2-2H5C3.346 3 2 4.346 2 6v12c0 2.201 1.794 3 3 3h15c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zm-2 9h-2v-4h2v4zM5 7a1.001 1.001 0 0 1 0-2h13v2H5z"></path>
                    </svg>
                    <span>Digital</span>
                </div>
            </div>
        </section>

        <section>
            @if ($paymentmode == "money")
                <form wire:submit.prevent="sendPaymentMoney">
                    <div class="my-2">
                        <p><span class="text-base font-medium text-gray-700 font-sans">Nota:</span> Al
                            elegir este método de pago también podrá pagar diferencia por punto de venta si así
                            lo desea</p>
                    </div>
                    <div class="custom-control custom-checkbox my-2">
                        <input type="checkbox" id="customCheck1" wire:model.defer="bank_id" value="money"
                            @if($paymentmode=="money" ) required @endif class="custom-control-input">
                        <label class="custom-control-label" for="customCheck1">Selecciona si Usaste este metodo
                            de Pago<span class="text-red-500 text-lg font-bold">*</span>
                        </label>
                    </div>

                    @if (Session::has('checkout'))
                        <div class="flex justify-end my-4">
                            <h1 class="text-base font-bold font-sans text-gray-800">Total a Pagar: 
                                @foreach ($this->dollar as $d)
                                {{number_format(round(($d->price*Session::get('checkout')['total']),2),2)}} 
                                <input type="number" hidden name="price_bs" wire:model.defer="price_bs" value="{{round($d->price*Session::get('checkout')['total']),2}}"> 
                                @endforeach Bs
                            </h1>
                        </div>
                    @endif

                    <hr />
                    <div class="flex justify-end my-2">
                        <button wire:click.prevent="cancelPayment"
                            class="p-2 mr-2 text-base text-white font-semibold bg-red-700 hover:bg-red-900 shadow-lg shadow-red-600">Cancelar</button>
                        <button type="submit"
                            class="p-2 mr-2 text-base text-white font-semibold bg-teal-600 hover:bg-teal-800 shadow-lg shadow-teal-600">Comprobar</button>
                    </div>
                </form>    
            @elseif($paymentmode == "bank")
                <form wire:submit.prevent="sendPaymentBank">
                    @if (count($this->bank) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                            @foreach ($this->bank as $b)
                                @if ($b->pm == "si")
                                    <div class="col-span-1 md:col-span-1 lg:col-span-1">
                                        <h4 class="text-xl font-semibold font-sans my-4">Transferencias</h4>
                                        <p><span class="mb-1 text-base font-semibold text-gray-700">Banco:</span> {{
                                            $b->bank->name }}</p>
                                        <p><span class="mb-1 text-base font-semibold text-gray-700">Beneficiario:</span> {{
                                            $b->beneficiary }}</p>
                                        <p><span class="mb-1 text-base font-semibold text-gray-700">Cedula:</span> {{ $b->type_d
                                            }}-{{ $b->cedula }}</p>
                                        <p><span class="mb-1 text-base font-semibold text-gray-700">Nro. de Cuenta:</span> {{
                                            $b->account }}</p>
                                        <p><span class="mb-1 text-base font-semibold text-gray-700">Tipo de Cuenta:</span> {{
                                            $b->type_account }}</p>
                                    </div>
                                    <div class="col-span-1 md:col-span-1 lg:col-span-1">
                                        <h4 class="text-xl font-semibold font-sans my-4">Pago Móvil</h4>
                                        <p><span class="mb-1 text-base font-semibold text-gray-700">Banco:</span> ({{
                                            $b->bank->code }}) {{ $b->bank->name }}</p>
                                        <p><span class="mb-1 text-base font-semibold text-gray-700">Cedula:</span> {{ $b->type_d
                                            }}-{{ $b->cedula }}</p>
                                        <p><span class="mb-1 text-base font-semibold text-gray-700">Teléfono:</span> {{
                                            $b->phone }}</p>
                                    </div>
                                @else
                                    <div class="col-span-1 md:col-span-1 lg:col-span-1">
                                        <h4 class="text-xl font-semibold font-sans my-4">Transferencias</h4>
                                        <p><span class="mb-1 text-base font-semibold text-gray-700">Banco:</span> ({{
                                            $b->bank->code }}) {{ $b->bank->name }}</p>
                                        <p><span class="mb-1 text-base font-semibold text-gray-700">Beneficiario:</span> {{
                                            $b->beneficiary }}</p>
                                        <p><span class="mb-1 text-base font-semibold text-gray-700">Cedula:</span> {{ $b->tipo_d
                                            }}-{{ $b->cedula }}</p>
                                        <p><span class="mb-1 text-base font-semibold text-gray-700">Nro. de Cuenta:</span> {{
                                            $b->account }}</p>
                                        <p><span class="mb-1 text-base font-semibold text-gray-700">Tipo de Cuenta:</span> {{
                                            $b->type_account }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <hr />

                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <hr class="md:hidden lg:hidden">
                            <h5 class="my-2 text-center text-lg font-semibold font-sans">Datos de la Transferencia</h5>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div class="col-span-2 md:col-span-1 lg:col-span-1">
                                    <label for="referencia" class="font-sans font-semibold text-gray-700">Nro. de
                                        Referencia<span class="text-red-500 text-lg font-bold">*</span></label>
                                    <input type="number" name="referencia"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md"
                                        wire:model.defer="referencia" min="1" placeholder="Ingrese el Nro. Referencia">
                                    @error('referencia')
                                    <small class=text-red-600">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-span-2 md:col-span-1 lg:col-span-1">
                                    <label for="captura" class="font-sans font-semibold text-gray-700">
                                        Captura de la Trasnferencia (Opcional)</label>
                                    <input type="file"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md"
                                        accept='image/*' wire:model.defer="captura"
                                        placeholder="Seleccione Una Imagen" />
                                </div>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox my-2">
                            <input type="checkbox" id="customCheck1" wire:model.defer="bank_id" value="{{ $b->id }}"
                                @if($paymentmode=="bank" ) required @endif class="custom-control-input">
                            <label class="custom-control-label" for="customCheck1">Selecciona si Usaste este metodo
                                de Pago<span class="text-red-500 text-lg font-bold">*</span></label>
                        </div>

                        @if (Session::has('checkout'))
                            <div class="flex justify-end my-4">
                                <h1 class="text-base font-bold font-sans text-gray-800">Total a Pagar: 
                                    @foreach ($this->dollar as $d)
                                    {{number_format(round(($d->price*Session::get('checkout')['total']),2),2)}} 
                                    <input type="number" hidden name="price_bs" wire:model.defer="price_bs" value="{{round($d->price*Session::get('checkout')['total']),2}}"> 
                                    @endforeach Bs
                                </h1>
                            </div>
                        @endif

                            <hr />
                            <div class="flex justify-end my-2">
                                <button wire:click.prevent="cancelPayment"
                                    class="p-2 mr-2 text-base text-white font-semibold bg-red-700 hover:bg-red-900 shadow-lg shadow-red-600">Cancelar</button>
                                <button type="submit"
                                    class="p-2 mr-2 text-base text-white font-semibold bg-teal-600 hover:bg-teal-800 shadow-lg shadow-teal-600">Comprobar</button>
                            </div>
                        @else
                            <h1 class="my-4 text-xl text-center font-medium text-gray-700 font-sans">No hay método de pago agregado</h1>
                    @endif
                </form>    
            @elseif($paymentmode == "wallet")
                <form wire:submit.prevent="sendPaymentWallet">
                    @if (count($this->wallet) > 0)
                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            @foreach ($this->wallet as $w)
                                <h4 class="text-xl text-center font-semibold font-sans my-4">Información general</h4>
                                <p><span class="text-base font-semibold text-gray-700">Plataforma:</span> {{ $w->name }}</p>
                            @if ($w->type == "crypto")
                                <p><span class="mb-1 text-base font-semibold text-gray-700">Billetera:</span> {{ $w->wallet_email }}</p>
                            @else
                                <p class="my-2"><span class="text-base font-semibold text-gray-700">Correo Electrónico:</span> {{ $w->wallet_email }}</p>
                            @endif
                                <hr />
                            @endforeach
                        </div>

                        <div class="col-span-2 md:col-span-1 lg:col-span-1">
                            <hr class="md:hidden lg:hidden">
                            <h5 class="my-2 text-center text-lg font-semibold font-sans">Datos de la Transferencia</h5>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div class="col-span-2 md:col-span-1 lg:col-span-1">
                                    <label for="referencia" class="font-sans font-semibold text-gray-700">Nro. de
                                        Referencia<span class="text-red-500 text-lg font-bold">*</span></label>
                                    <input type="number" name="referencia"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md"
                                        wire:model.defer="referencia" min="1" placeholder="Ingrese el Nro. Referencia">
                                    @error('referencia')
                                    <small class=text-red-600">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-span-2 md:col-span-1 lg:col-span-1">
                                <label for="captura" class="font-sans font-semibold text-gray-700">
                                    Captura de la Trasnferencia (Opcional)</label>
                                <input type="file"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md"
                                    accept='image/*' wire:model.defer="captura"
                                    placeholder="Seleccione Una Imagen" />
                                </div>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox col-span-2 my-2">
                            <input type="checkbox" id="customCheck2" wire:model.defer="wallet_id"
                                value="{{ $w->id }}" @if($paymentmode=="wallet" ) required @endif
                                class="custom-control-input">
                            <label class="custom-control-label" for="customCheck2">Selecciona si Usaste este metodo
                                de Pago<span class="text-red-500 text-lg font-bold">*</span></label>
                        </div>

                        @if (Session::has('checkout'))
                            <div class="flex justify-end my-4">
                                <h1 class="text-base font-bold font-sans text-gray-800">Total a Pagar: 
                                    @foreach ($this->dollar as $d)
                                    {{number_format(round(($d->price*Session::get('checkout')['total']),2),2)}} 
                                    <input type="number" hidden name="price_bs" wire:model.defer="price_bs" value="{{round($d->price*Session::get('checkout')['total']),2}}"> 
                                    @endforeach Bs
                                </h1>
                            </div>
                        @endif

                            <hr />
                            <div class="flex justify-end my-2">
                                <button wire:click.prevent="cancelPayment"
                                    class="p-2 mr-2 text-base text-white font-semibold bg-red-700 hover:bg-red-900 shadow-lg shadow-red-600">Cancelar</button>
                                <button type="submit"
                                    class="p-2 mr-2 text-base text-white font-semibold bg-teal-600 hover:bg-teal-800 shadow-lg shadow-teal-600">Comprobar</button>
                            </div>
                        @else
                            <h1 class="text-base font-semibold text-gray-700 font-sans">No hay método de pago agregado</h1>
                    @endif

                </form>        
            @endif  
        </section>
    </main>
</div>
