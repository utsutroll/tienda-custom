<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Listado de Billeteras Electrónicas</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Listado de Billeteras Electrónicas</li>
                </ol>
                <button type="button" class="btn btn-success btn-md float-right m-l-15" data-toggle="modal" data-target="#create-modal" wire:click='create'><i class="fa fa-plus-circle"></i> Nueva Billetera</button>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    @include("livewire.admin.partials.$view")

    @include('livewire.admin.partials.editWallet')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Billeteras</h4>
            
            <div class="table-responsive m-t-2">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Plataforma</th>
                            <th>Tipo de Billetera</th>
                            <th>Billetera</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wallets as $w)
                           
                        <tr>
                            <td width="8%">{{ $w->id }}</td>
                            <td>{{ $w->name }}</td>
                            <td>{{ $w->type }}</td>
                            <td>{{ $w->wallet_email }}</td>
    
                            <td width="20%">
                                <button 
                                    class="btn btn-info btn-sm mr-2"
                                    data-toggle="modal" data-target="#edit-modal"
                                    wire:click="edit({{$w->id}})">
                                    <i class="ti-pencil"></i> 
                                    Editar
                                </button>

                                <button 
                                    class="btn btn-danger btn-sm"
                                    wire:click="destroy({{$w->id}})">
                                    <i class="ti-trash"></i> 
                                    Eliminar
                                </button>
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
          
    $('#liWallets').addClass("active");

    window.livewire.on('walletAdded',()=>{
        $('#create-modal').modal('hide');

        $.toast({
            heading: 'Notificación',
            text: 'La Billetera se guardó con éxito.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          });
    });

    window.livewire.on('walletEdited',()=>{
        $('#edit-modal').modal('hide');

        $.toast({
            heading: 'Notificación',
            text: 'La Billetera se actualizó con éxito.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          });
    });
    window.livewire.on('walletDeleted',()=>{

        $.toast({
            heading: 'Notificación',
            text: 'La Billetera se eliminó con éxito.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'info',
            hideAfter: 3500, 
            stack: 6
          });
    });
    window.livewire.on('walletDeleted_e',()=>{

        $.toast({
            heading: 'Notificación',
            text: 'La Billetera se encuentra asignada a un Pago, no puede ser eliminada.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 3500, 
            stack: 6
          });
    });

</script>
@endpush 