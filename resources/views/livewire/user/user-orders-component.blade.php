<div class="p-2 md:p-4 lg:p-4 m-2 md:m-4 lg:m-4">
    <div class="py-4 px-5 my-4 text-gray-900 rounded-md text-sm border-b border-gray-200">
        <div class="flex flex-col-reverse md:flex-row lg:flex-row">
            <div class="flex-1 justify-items-start mt-4 md:mt-0 lg:mt-0">
                <h4 class="text-lg font-sans font-semibold">Listado de Órdenes</h4>
            </div>

            <ul class="flex justify-items-end">
                <li><a href="{{ route('shop') }}" class="underline font-semibold">Tienda</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('user.dashboard') }}" class="underline font-semibold">Panel Administrativo</a></li>
                <li><span class="mx-2">/</span></li>
                <li>Listado de Órdenes</li>
            </ul>
        </div>
        
    </div>

    <div class="flex flex-wrap -mx-4 my-4 p-4">
        <div class="w-full px-4">
            <h4 class="my-4 text-start text-lg font-semibold font-sans">Mis Órdenes</h4>

            <div class="max-w-full">
                @if (count($orders) > 0)
                <table id="table" class="table is-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%">Id</th>
                            <th>Nombre y Apellido</th>
                            <th>Télefono</th>
                            <th>Total $</th>
                            <th>Total Bs</th>
                            <th>Estatus Pedido</th>
                            <th>Estatus Pago</th>
                            <th>Fecha de la Orden</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $o)
                        <tr>
                            <td width="5%">
                                {{ $o->id }}        
                            </td>
                            <td>
                                {{ $o->firstname }} {{ $o->lastname }}    
                            </td>
                            <td>
                                {{ $o->mobile }}
                            </td>
                            <td>
                                {{ $o->total }} $
                            </td>
                            <td>
                                {{ number_format($o->total_bs) }} Bs
                            </td>
                            <td>
                                @if ($o->status == "ordered")
                                    <button class="p-1 text-center text-base text-white rounded-md bg-blue-500 hover:bg-blue-700">Ordenada</button>
                                @elseif($o->status == "delivered")
                                    <button class="p-1 text-center text-base text-white rounded-md bg-green-600 hover:bg-green-800">Entregada</button>
                                @else
                                    <button class="p-1 text-center text-base text-white rounded-md bg-red-600 hover:bg-red-800">Cancelada</button>
                                @endif
                            </td>
                            <td>
                                @if ($o->transactions == null)
                                    <div class="p-1 text-center text-base text-white rounded-md bg-yellow-400 hover:bg-yellow-600">No Enviado</div>
                                @else  
                                    @if ($o->transactions->status == "pending")
                                    <div class="p-1 text-center text-base text-white rounded-md bg-blue-500 hover:bg-blue-700">Pendiente</div>    
                                    @elseif ($o->transactions->status == "approved")
                                        <div class="p-1 text-center text-base text-white rounded-md bg-green-600 hover:bg-green-800">Aprobado</div>
                                    @elseif ($o->transactions->status == "declined")
                                        <div class="p-1 text-center text-base text-white rounded-md bg-red-600 hover:bg-red-800">Rechazada</div>
                                    @endif
                                @endif
                            </td>
                            <td>
                                {{ $o->created_at }}
                            </td>
                            <td>
                                <a href="{{ route('user.orderdetails',['order_id'=>$o->id]) }}" class="p-2 text-base text-white rounded-md bg-blue-500 hover:bg-blue-700">
                                    <i class="far fa-eye"></i>
                                    Detalles
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-4 border-t border-gray-700">
                    <div class="flex justify-end">
                        {{$orders->links()}}
                    </div>
                </div> 
                @else
                <table id="table" class="table is-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%">Id</th>
                            <th>Nombre y Apellido</th>
                            <th>Télefono</th>
                            <th>Total $</th>
                            <th>Total Bs</th>
                            <th>Estatus Pedido</th>
                            <th>Estatus Pago</th>
                            <th>Fecha de la Orden</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td colspan="9">No se Encontraron Registros</td>
                        </tr>
                    </tbody>
                </table> 
                </div>
                </div>      
            @endif
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                language: {
                    lengthMenu: 'Mostrar _MENU_ registros por página',
                    zeroRecords: 'No se ha encontrado nada - lo siento',
                    info: 'Mostrar página _PAGE_ de _PAGES_',
                    infoEmpty: 'No hay registros disponibles',
                    infoFiltered: '(filtrado de _MAX_ total de registros)',
                    sSearch: "Buscar:",
                    oPaginate: {
                        sFirst: "Primero",
                        sLast: "Último",
                        sNext: "Siguiente",
                        sPrevious: "Anterior",
                    },
                },
            });
        });
    </script>
@endpush

