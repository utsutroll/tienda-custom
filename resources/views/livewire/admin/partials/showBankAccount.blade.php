 <!-- sample modal content -->
 <div wire:ignore.self id="show-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="create-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title text-black font-bold">Ver Datos Bancarios</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                
                <div wire:loading>
                    <div class="loader">
                        <div>
                           <img class="animate-pulse" width="35" height="35" src="{{ asset('assets/images/logo/logo-pulso.svg') }}" alt="Logo La Mega Tienda Turen">
                        </div>    
                    </div>
                    <div>
                        <br><br><br><br><br><br><br>
                    </div>
                </div>
                <div wire:loading.remove>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-base font-bold">Documento de Identidad</td>
                                    <td>{{$type_d}}-{{$cedula}}</td>
                                </tr>
                                <tr>
                                    <td class="text-base font-bold">Beneficiario</td>
                                    <td>{{$beneficiary}}</td>
                                </tr>
                                <tr>
                                    <td class="text-base font-bold">Tipo de Cuenta</td>
                                    <td>{{$type_account}}</td>
                                </tr>
                                <tr>
                                    <td class="text-base font-bold">Banco</td>
                                    <td>({{$code}}) {{$bankn}}</td>
                                </tr>
                                <tr>
                                    <td class="text-base font-bold">Nro. de Cuenta</td>
                                    <td>{{$account}}</td>
                                </tr>
                                <tr>
                                    <td class="text-base font-bold">Teléfono</td>
                                    <td>{{$phone}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
