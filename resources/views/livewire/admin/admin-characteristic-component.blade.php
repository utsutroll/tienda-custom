<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Listado de Características</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Listado de Características</li>
                </ol>
                <button type="button" class="btn btn-success btn-md float-right m-l-15" data-toggle="modal" data-target="#create-modal" wire:click='create'><i class="fa fa-plus-circle"></i> Nueva Característica</button>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    @include("livewire.admin.partials.$view")

    @include('livewire.admin.partials.editCharacteristic')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Característica</h4>
            
            <div class="table-responsive m-t-2">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Característica</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($characteristics as $c)
                           
                        <tr>
                            <td width="8%">{{ $c->id }}</td>
                            <td>{{ $c->name }}</td>
    
                            <td>
                                <button 
                                    class="btn btn-info btn-sm mr-2"
                                    data-toggle="modal" data-target="#edit-modal"
                                    wire:click="edit({{$c->id}})">
                                    <i class="ti-pencil"></i> 
                                    Editar
                                </button>
                            
                                <button 
                                    class="btn btn-danger btn-sm"
                                    wire:click="destroy({{$c->id}})">
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
      
$('#LiCharacteristic').addClass("active");

window.livewire.on('characteristicAdded',()=>{
    $('#create-modal').modal('hide');
    $.toast({
        heading: 'Notificación',
        text: 'La Característica se creó con éxito.',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'success',
        hideAfter: 3500, 
        stack: 6
      });
});
window.livewire.on('characteristicEdited',()=>{
    $('#edit-modal').modal('hide');
    $.toast({
        heading: 'Notificación',
        text: 'La Característica se actualizó con éxito.',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'success',
        hideAfter: 3500, 
        stack: 6
      });
});
window.livewire.on('characteristicDeleted',()=>{
    $.toast({
        heading: 'Notificación',
        text: 'La Característica se eliminó con éxito.',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'info',
        hideAfter: 3500, 
        stack: 6
      });
});
window.livewire.on('characteristicDeleted_e',()=>{
    $.toast({
        heading: 'Notificación',
        text: 'La Característica se encuentra asignada a un producto, no puede ser eliminada.',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'error',
        hideAfter: 3500, 
        stack: 6
      });
});
</script>
@endpush