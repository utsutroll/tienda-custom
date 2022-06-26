<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Detalles de la Orden</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.orders')}}">Listado de Órdenes</a></li>
                    <li class="breadcrumb-item active">Detalle de la Orden</li>
                </ol>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Detalles del Pedido
                    <div class="card-actions">
                        <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                        <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                        <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                    </div>
                </div>
                <div class="card-body collapse show">
                    <div class="table-responsive">
                        <table class="table product-overview">
                           
                                <tr>
                                    <th>Id del Pedido</th>
                                    <td>{{ $order->id }}</td>
                                    <th>Fecha del Pedido</th>
                                    <td>{{ $order->created_at }}</td>
                                    <th>Estatus</th>
                                    <td>
                                        @if ($order->status == "ordered")
                                            <div class="badge badge-info">Ordenado</div>
                                        @elseif($order->status == "delivered")
                                            <div class="badge badge-success">Entregado</div>
                                        @elseif($order->status == "canceled")
                                            <div class="badge badge-danger">Cancelado</div>
                                        @endif
                                    </td>
                                    @if ($order->status == "delivered")
                                    <th>Fecha de Entregas</th>
                                    <td>{{ $order->delivered_date }}</td>    
                                    @elseif($order->status == "canceled")
                                    <th>Fecha de Cancelación</th>
                                    <td>{{ $order->canceled_date }}</td>   
                                    @endif
                                    
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Productos Ordenados
                    <div class="card-actions">
                        <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                        <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                        <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                    </div>
                </div>
                <div class="card-body collapse show">
                    <div class="table-responsive">
                        <table class="table product-overview">
                            <thead>
                                <tr>
                                    <th>Imágen</th>
                                    <th>Información del producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th style="text-align:center">SubTotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->characteristic_product_order as $item) 
                                <tr>
                                    <td width="150"><img src="{{ Storage::url($item->characteristic_product->image) }}" width="80"></td>
                                    <td width="550">
                                        <h5 class="font-500">{{ $item->characteristic_product->product->name }} {{ $item->characteristic_product->product->brand->name }} {{ $item->characteristic_product->characteristic->name }}</h5>
                                    </td>
                                    <td>{{$item->price}}$</td>
                                    <td width="80">{{ $item->quantity }}</td>
                                    <td width="150" align="center" class="font-500">{{ round(($item->price*$item->quantity),2) }}$</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr/>
                        <div class="form-group d-flex justify-content-end my-3">
                            <h5 class="text-base font-bold text-gray-800">Total Pagado: {{ $order->total }}$ ~ {{ number_format(round($order->total_bs,2),2)}} Bs</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Detalles de la Facturación
                    <div class="card-actions">
                        <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                        <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                        <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                    </div>
                </div>
                <div class="card-body collapse show">
                    <div class="table-responsive">
                        <table class="table product-overview">
                            <thead>
                                <th>Cédula</th>
                                <th>Nombre y Apellido</th>
                                <th>Teléfono</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order->cedula }}</td>
                                    <td>{{ $order->firstname }} {{ $order->lastname }}</td>
                                    <td>{{ $order->mobile }}</td>
                                </tr>    
                            </tbody>    
                        </table>
                    </div> 
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Detalles de la Transacción
                    <div class="card-actions">
                        <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                        <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                        <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                    </div>
                </div>
                <div class="card-body collapse show">
                    <div class="table-responsive">
                        <table class="table product-overview">
                            @if ($order->transactions == null)
                                <tr class="text-center">
                                    <td>Los datos del pago no fueron enviados</td>
                                </tr>
                            @else  

                                <tr>
                                    <th>Modo de Transacción</th>
                                    <td>
                                        @if ($order->transactions->mode == "bank")
                                            Transferencia o Pago Móvil
                                        @elseif($order->transactions->mode == "wallet")
                                            Billetera Virtual
                                        @else
                                            Efectivo    
                                        @endif
                                    </td>
                                </tr>    
                                <tr>
                                    <th>Estatus</th>
                                    <td>
                                        @if ($order->transactions->status == "pending")
                                            <div class="badge badge-info">Pendiente</div>    
                                        @elseif ($order->transactions->status == "approved")
                                            <div class="badge badge-success">Aprobado</div>
                                        @elseif ($order->transactions->status == "declined")
                                            <div class="badge badge-danger">Rechazada</div>
                                        @endif
                                    </td>
                                </tr>    
                                <tr>
                                    <th>Fecha de la Transacción</th>
                                    <td>{{ $order->transactions->created_at }}</td>
                                </tr>
                                @if ($order->transactions->mode != "money")    
                                    <tr>
                                        <th>Referencia</th>
                                        <td>{{ $order->transactions->reference }}</td>
                                    </tr>    
                                    <tr>
                                        <th>Captura</th>
                                        <td width="150"><img src="{{Storage::url($order->transactions->url)}}" width="250"></td>
                                    </tr>
                                @endif 
                            @endif 

                            @if ($order->status !== 'canceled')
                                   
                                @if ($order->transactions !== null)
                                    @if ($order->transactions->status == "pending")
                                        <tr>
                                            <th><div class="form-group"><input type="text" wire:model.defer="observation" class="form-control" placeholder="Observación"></div></th>
                                            <td colspan="2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button class="btn btn-success btn-small ml-2" wire:click.prevent="approvePayment">Aprobar Pago</button>            
                                                    </div>
                                                    <div class="col-6">
                                                        <button class="btn btn-danger btn-small" wire:click.prevent="declinedPayment">Rechazar Pago</button>
                                                    </div>
                                                </div>    
                                            </td>
                                        </tr>
                                    @endif    
                                @endif

                                @if ($order->transactions->observation !== null && $order->status !== 'canceled')
                                    <tr>
                                        <th>Observación</th>
                                        <td>{{ $order->transactions->observation }}</td>
                                    </tr>
                                @endif
                            @endif       
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
