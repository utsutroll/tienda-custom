<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Listado de Pedidos</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Listado de Pedidos</li>
                </ol>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Pedidos</h4>
            
            <div class="table-responsive m-t-2">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre y Apellido</th>
                            <th>Teléfono</th>
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
                            <td width="2%">{{ $o->id }}</td>
                            <td>{{$o->firstname}} {{$o->lastname}}</td>
                            <td>{{$o->mobile}}</td>
                            <td>{{$o->total}} $</td>
                            <td>{{number_format($o->total_bs)}} Bs</td>
                            <td>@if ($o->status == "ordered")
                                <div class="btn-group mt-2">
                                    <button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ordenada
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)" wire:click.prevent="updateOrderStatus({{ $o->id }}, 'delivered')">Entregado</a>
                                        <a class="dropdown-item" href="javascript:void(0)" wire:click.prevent="updateOrderStatus({{ $o->id }}, 'canceled')">Cancelado</a>
                                    </div>
                                </div>
                                @elseif($o->status == "delivered")
                                    <button class="btn btn-sm btn-success">Entregada</button>
                                @else
                                    <button class="btn btn-sm btn-danger">Cancelada</button>
                                @endif
                            </td>
                            <td>  
                                @if ($o->status_pago == "pending")
                                <div class="btn btn-sm btn-info">Pendiente</div>    
                                @elseif ($o->status_pago == "approved")
                                    <div class="btn btn-sm btn-success">Aprobado</div>
                                @elseif ($o->status_pago == "declined")
                                    <div class="btn btn-sm btn-danger">Rechazada</div>
                                @endif
                                
                            </td>
                            <td>{{$o->created_at}}</td>
                            <td>
                                <a href="{{ route('admin.orderdetails',['order_id'=>$o->id]) }}"
                                    class="btn btn-primary btn-sm mr-2"
                                    >
                                    <i class="ti-eye"></i> 
                                    Detalles
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>       
    </div>
</div>    
@push('scripts')
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