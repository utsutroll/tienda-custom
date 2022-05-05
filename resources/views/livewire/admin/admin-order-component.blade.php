<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Listado de Órdenes</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Listado de Órdenes</li>
                </ol>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Órdenes</h4>
            <h6 class="card-subtitle"></h6>
            <div class="m-t-4">
                <div class="dataTables_length" id="myTable_length">
                    <label>Mostrar 
                        <select wire:model="entries"  class="">
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> 
                    Entradas</label>
                </div>
            </div>
            
            <div class="table-responsive m-t-2">
                @if (count($orders) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">Id</th>
                            <th>Nombre y Apellido</th>
                            <th>Teléfono</th>
                            <th>Total $</th>
                            <th>Total Bs</th>
                            <th>Estatus Pedido</th>
                            <th>Estatus Pago</th>
                            <th>Fecha de la Orden</th>
                            <th class="text-nowrap text-center" colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $o)
                        <tr>
                            <td width="2%">{{ $o->id }}</td>
                            <td>{{$o->firstname}} {{$o->lastname}}</td>
                            <td>{{$o->mobile}}</td>
                            <td>{{$o->total}} $</td>
                            <td>{{number_format($o->total_bs)}} Bs</td>
                            <td>@if ($o->status == "ordered")
                                <button class="btn btn-sm btn-info">Ordenada</button>
                            @elseif($o->status == "delivered")
                                <button class="btn btn-sm btn-success">Entregada</button>
                            @else
                                <button class="btn btn-sm btn-danger">Cancelada</button>
                            @endif</td>
                            <td>
                                @if ($o->transactions == null)
                                    <div class="btn btn-sm btn-warning">No Enviado</div>
                                @else  
                                    @if ($o->transactions->status == "pending")
                                    <div class="btn btn-sm btn-info">Pendiente</div>    
                                    @elseif ($o->transactions->status == "approved")
                                        <div class="btn btn-sm btn-success">Aprobado</div>
                                    @elseif ($o->transactions->status == "declined")
                                        <div class="btn btn-sm btn-danger">Rechazada</div>
                                    @endif
                                @endif
                            </td>
                            <td>{{$o->created_at}}</td>
                            <td width="10px" class="text-nowrap">
                                <a href="{{ route('admin.orderdetails',['order_id'=>$o->id]) }}"
                                    class="btn btn-primary btn-sm"
                                    >
                                    <i class="ti-eye"></i> 
                                    Detalles
                                </a>
                            </td>
                            @if($o->status == "ordered")
                            <td width="10px" class="text-nowrap">
                                <div class="btn-group">
                                    <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Estatus
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" wire:click.prevent="updateOrderStatus({{ $o->id }}, 'delivered')">Entregado</a>
                                        <a class="dropdown-item" href="#" wire:click.prevent="updateOrderStatus({{ $o->id }}, 'canceled')">Cancelado</a>
                                    </div>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="float-right">
                {{$orders->links()}}
            </div>
        </div> 
        @elseif (count($orders) == 0 & $search !== '')
            <div class="card-body">
                No hay un resultado para la busqueda "{{$search}}"  
            </div>
            </div>
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Fecha de Entrada</th>
                        <th colspan="2" class="text-nowrap">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td colspan="5">No se Encontraron Registros</td>
                    </tr>
                </tbody>
            </table> 
            </div>
            </div>      
        @endif 
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

    window.livewire.on('orderUpdateC',()=>{

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
