<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Listado de Subcategorías</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Listado de Subcategorías</li>
                </ol>
                <button type="button" class="btn btn-success btn-md float-right m-l-15" data-toggle="modal" data-target="#create-modal" wire:click='create'><i class="fa fa-plus-circle"></i> Nueva Subcategoría</button>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    @include("livewire.admin.partials.$view")

    @include('livewire.admin.partials.editSubcategory')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Subcategorías</h4>
            
            <div class="table-responsive m-t-2">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subcategoría</th>
                            <th>Categoría</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $s)
                           
                        <tr>
                            <td width="8%">{{ $s->id }}</td>
                            <td>{{ $s->name }}</td>
                            <td>{{ $s->category->name }}</td>
    
                            <td width="20%">
                                <button 
                                    class="btn btn-info btn-sm mr-2"
                                    data-toggle="modal" data-target="#edit-modal"
                                    wire:click="edit({{$s->id}})">
                                    <i class="ti-pencil"></i> 
                                    Editar
                                </button>

                                <button 
                                    class="btn btn-danger btn-sm"
                                    wire:click="destroy({{$s->id}})">
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
    
@push('css')
<link href="{{asset('assets/node_modules/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/node_modules/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
@endpush
@push('scripts')
<script src="{{asset('assets/node_modules/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/node_modules/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
$(".select2").select2();
$('#LiSubcategories').addClass("active");

window.livewire.on('subcategoryAdded',()=>{
    $('#create-modal').modal('hide');
    $.toast({
        heading: 'Notificación',
        text: 'La Subcategoría se creó con éxito.',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'success',
        hideAfter: 3500, 
        stack: 6
      });
});
window.livewire.on('subcategoryEdited',()=>{
    $('#edit-modal').modal('hide');
    $.toast({
        heading: 'Notificación',
        text: 'La Subcategoría se actualizó con éxito.',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'success',
        hideAfter: 3500, 
        stack: 6
      });
});
window.livewire.on('subcategoryDeleted',()=>{
    $.toast({
        heading: 'Notificación',
        text: 'La Subcategoría se eliminó con éxito.',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'info',
        hideAfter: 3500, 
        stack: 6
      });
});
window.livewire.on('subcategoryDeleted_e',()=>{
    $.toast({
        heading: 'Notificación',
        text: 'La Subcategoría se encuentra asignada a un producto, no puede ser eliminada.',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'error',
        hideAfter: 3500, 
        stack: 6
      });
});
window.livewire.on('slugValidate',()=>{
    $.toast({
        heading: 'Notificación',
        text: 'La Subcategoría ya se encuetra registrada.',
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: 'error',
        hideAfter: 5500, 
        stack: 6
      });
});
</script>
@endpush