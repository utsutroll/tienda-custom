<div class="p-2 md:p-4 lg:p-4 m-2 md:m-4 lg:m-4">
    <div class="py-4 px-5 my-2 text-gray-900 rounded-md text-sm border-b border-gray-200">
        <div class="flex flex-col-reverse md:flex-row lg:flex-row">
            <div class="flex-1 justify-items-start mt-4 md:mt-0 lg:mt-0">
                <h4 class="text-lg font-sans font-semibold">Detalles de la Orden</h4>
            </div>

            <ul class="flex justify-items-end">
                <li><a href="{{ route('shop') }}" class="underline font-semibold">Tienda</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('user.orders') }}" class="underline font-semibold">Listado de Órdenes</a></li>
                <li><span class="mx-2">/</span></li>
                <li>Detalle de la Orden</li>
            </ul>
        </div>
    </div>


    <div class="my-6 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha del Pedido
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estatus
                    </th>
                    @if ($order->status == "delivered")
                    <th scope="col" class="px-6 py-3">
                        Fecha de Entrega
                    </th>
                    @elseif($order->status == "canceled")
                    <th scope="col" class="px-6 py-3">
                        Fecha de Cancelación
                    </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{ $order->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $order->created_at }}
                    </td>
                    <td>
                        @if ($order->status == "ordered")
                        <div
                            class="p-1 w-24 rounded-md text-center text-base text-white font-medium bg-blue-500 hover:bg-blue-700">
                            Ordenada</div>
                        @elseif($order->status == "delivered")
                        <div
                            class="p-1 w-24 rounded-md text-center text-base text-white font-medium bg-green-500 hover:bg-green-700">
                            Entregado</div>
                        @elseif($order->status == "canceled")
                        <div
                            class="p-1 w-24 rounded-md text-center text-base text-white font-medium bg-red-500 hover:bg-red-700">
                            Cancelado</div>
                        @endif
                    </td>
                    @if ($order->status == "delivered")
                    <td class="px-6 py-4 text-right">
                        {{ $order->delivered_date }}
                    </td>
                    @elseif($order->status == "canceled")
                    <td class="px-6 py-4 text-left">
                        {{ $order->canceled_date }}
                    </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>


    <div class="my-6 relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="px-4 py-2 sm:px-6">
            <h3 class="text-lg leading-6 font-medium font-sans text-gray-900">Detalles de los Productos</h3>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Producto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Imágen
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Precio
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Cantidad
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        SubTotal
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->characteristic_product_order as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{ $item->characteristic_product->product->name }} {{ $item->characteristic_product->product->brand->name }} {{ $item->characteristic_product->characteristic->name }}
                    </th>
                    <td class="px-6 py-4">
                        <img src="{{ Storage::url($item->characteristic_product->image) }}" width="80">
                    </td>
                    <td width="150" class="px-6 py-4">
                        @foreach  ($this->dollar as $d) {{ round(($item->price*$d->price),2) }} @endforeach Bs
                    </td>
                    <td width="80" class="px-6 py-4 text-center">
                        {{ $item->quantity }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @foreach  ($this->dollar as $d) {{ round(($item->price*$item->quantity*$d->price),2) }} @endforeach Bs
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <hr />
        <div class="flex justify-end my-3 mr-2">
            <h5 class="text-base font-bold text-gray-800">Total Pagado: {{ number_format(round($order->total_bs,2),2)}} Bs</h5>
        </div>
    </div>

    <div class="my-6 relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="px-4 py-2 sm:px-6">
            <h3 class="text-lg leading-6 font-medium font-sans text-gray-900">Detalles de la Facturación</h3>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Cédula
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre y Apellido
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Teléfono
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{ $order->cedula }}
                    </th>
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{ $order->firstname }} {{ $order->lastname }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $order->mobile }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-6 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-2 sm:px-6">
            <h3 class="text-lg leading-6 font-medium font-sans text-gray-900">Detalles de la Transacción</h3>
        </div>
        <div class="border-t border-gray-200">
            @if ($order->transactions == null)
            <div class="tex-center">
                <h3 class="text-lg leading-6 font-medium font-sans text-gray-900">Los datos del pago no fueron enviados</h3>
            </div>
            @else
            <dl>
                <div class="bg-gray-50 px-4 pt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-lg font-medium text-gray-800">Modo de Transacción</dt>
                    <dd class="mt-1 text-base font-semibold text-gray-900 sm:mt-0 sm:col-span-2">
                        @if ($order->transactions->mode == "bank")
                            Transferencia o Pago Móvil
                        @elseif($order->transactions->mode == "wallet")
                            Billetera Virtual
                        @else
                            Efectivo
                        @endif
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-lg font-medium text-gray-800">Estatus</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if ($order->transactions->status == "pending")
                            <div class="p-1 w-24 rounded-md text-center text-base text-white font-medium bg-blue-500 hover:bg-blue-700">Pendiente</div>
                        @elseif ($order->transactions->status == "approved")
                            <div class="p-1 w-24 rounded-md text-center text-base text-white font-medium bg-green-500 hover:bg-green-700">Aprobado</div>
                        @elseif ($order->transactions->status == "declined")
                            <div class="p-1 w-24 rounded-md text-center text-base text-white font-medium bg-red-500 hover:bg-red-700">Rechazada</div>
                        @endif
                    </dd>
                </div>
                @if ($order->transactions->status == "declined")
                <div class="bg-white px-4 pb-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-lg font-medium text-gray-800">Observación</dt>
                    <dd class="mt-1 text-base font-semibold text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->transactions->observation }}</dd>
                </div>
                @endif
                <div class="bg-white px-4 pb-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-lg font-medium text-gray-800">Fecha de la Transacción</dt>
                    <dd class="mt-1 text-base font-semibold text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->transactions->created_at }}</dd>
                </div>
                @if ($order->transactions->mode != "money")
                    <div class="bg-white px-4 pb-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-lg font-medium text-gray-800">N° de Referencia</dt>
                        <dd class="mt-1 text-base font-semibold text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->transactions->reference }}</dd>
                    </div>
                    @isset($order->transactions->url)
                    <div class="bg-gray-50 px-4 pb-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-lg font-medium text-gray-800">Captura</dt>
                        <dd class="mt-1 text-base font-semibold text-gray-900 sm:mt-0 sm:col-span-2">
                            <img src="{{Storage::url($order->transactions->url)}}" width="150">    
                        </dd>
                    </div>
                    @endisset
                @endif
            </dl>
            @endif
        </div>
    </div>

    @push('scripts')
    <!-- This is data table -->
    <script src="{{url('assets/node_modules/datatables/jquery.dataTables.min.js')}}"></script>

    <script type="text/javascript">
        $('#liOrders').addClass("active");

    window.livewire.on('orderUpdate',()=>{

        $.toast({
            heading: 'Notificación',
            text: 'El estatus de del pedido se actualizó con éxito.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          });
    });

    </script>
    @endpush
</div>