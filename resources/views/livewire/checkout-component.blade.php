<div class="p-8 my-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
        <div class="cols-2 md:cols-1 lg:cols-1 mt-28">
            <img src="{{ url('dist/new/img/delivery.svg') }}" alt="">
        </div>
        <div class="cols-2 md:cols-1 lg:cols-1">
            <div class="p-6 bg-slate-200 rounded-md shadow-md shadow-black">
                <div class="m-2">
                    <h5 class="text-xl text-center font-semibold font-sans">Datos de la persona que retirará el pedido</h5>
                    <hr/>
                    <form wire:submit.prevent="placeOrder">
                    <div class="my-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                        <div class="cols-1 md:cols-2 lg:cols-2 my-4">
                            <div class="my-4">
                                <label for="" class="font-sans font-medium text-gray-700">Nombre<span style="color:red;">*</span></label>
                                <input type="text" name="firstname" wire:model.defer="firstname" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Ingrese Nombre">
                                @error('firstname')
                                    <small class="text-danger">{{$message}}</small>   
                                @enderror
                            </div>   

                            <div class="my-4">
                                <label for="" class="font-sans font-medium text-gray-700">Cédula<span style="color:red;">*</span></label>
                                <input type="number" name="cedula" wire:model.defer="cedula" min="1" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Ingrese la Cédula">
                                @error('cedula')
                                    <small class="text-danger">{{$message}}</small>   
                                @enderror
                            </div>  
                        </div>
                        <div class="cols-1 md:cols-2 lg:cols-2 my-4">
                            <div class="my-4">
                                <label for="" class="font-sans font-medium text-gray-700">Apellido<span style="color:red;">*</span></label>
                                <input type="text" name="lastname" wire:model.defer="lastname" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Ingrese Apellido">
                                @error('lastname')
                                    <small class="text-danger">{{$message}}</small>   
                                @enderror
                            </div> 

                            <div class="my-4">
                                <label for="" class="font-sans font-medium text-gray-700">Número de Teléfono<span style="color:red;">*</span></label>
                                <input type="number" name="mobile" wire:model.defer="mobile" min="1" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Ejem.(4121234567)">
                                @error('mobile')
                                    <small class="text-danger">{{$message}}</small>   
                                @enderror
                            </div>  
                        </div>
                    </div>
                    <hr/>
                    @if(Auth::user()->utype == "USR")
                    <div class="flex justify-end my-2">
                        <button wire:click.prevent="cancelCheckout" class="p-2 mr-2 text-base text-white font-semibold rounded-md bg-red-700 hover:bg-red-900 shadow-lg shadow-red-600">Cancelar</button>
                        <button type="submit" class="p-2 mr-2 text-base text-white font-semibold rounded-md bg-teal-600 hover:bg-teal-800 shadow-lg shadow-teal-600">Comprobar</button>
                    </div>
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
