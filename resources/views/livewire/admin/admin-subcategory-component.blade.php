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
            <div class="m-t-4">
                <div class="dataTables_length" id="myTable_length">
                    <label>Mostrar 
                        <select wire:model="entries"  class="">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> 
                    Entradas</label>
                </div>
                <div class="dataTables_filter">
                    <label>Buscar:
                        <input type="search" wire:model="search" class="" placeholder=""> 
                    </label>
                </div>
    
            </div>
            <div class="table-responsive m-t-2">
                @if (count($subcategories) > 0)
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th wire:click='sortBy("id")' style="cursor:pointer;">ID
                                <x-sort-icon sortField='id' :sort-by="$sortBy" :sort-asc="$sortAsc" />
                            </th>
                            <th wire:click='sortBy("subcategory")' style="cursor:pointer;">Subcategoría
                                <x-sort-icon sortField='subcategory' :sort-by="$sortBy" :sort-asc="$sortAsc" />
                            </th>
                            <th wire:click='sortBy("category")' style="cursor:pointer;">Categoría
                                <x-sort-icon sortField='category' :sort-by="$sortBy" :sort-asc="$sortAsc" />
                            </th>
                            <th>Imágen</th>
                            <th colspan="2" class="text-nowrap">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $s)
                           
                        <tr>
                            <td width="8%">{{ $s->id }}</td>
                            <td>{{ $s->subcategory }}</td>
                            <td>{{ $s->category }}</td>
                            <td width="40%"><img width="20%" @if ($s->url) src="{{Storage::url($s->url) }}" @else src="" @endif class="img-thumbnail"></td>
    
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
        <div class="card-footer">
            <div class="float-right">
                {{$subcategories->links()}}
            </div>
        </div> 
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subcategoría</th>
                        <th>Categoría</th>
                        <th>Imágen</th>
                        <th colspan="2" class="text-nowrap">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        @if (count($subcategories) == 0 & $search !== '')
                            <td colspan="3">No hay un resultado para la busqueda "{{$search}}"</td>
                        @else
                            <td colspan="3">No se Encontraron Registros</td>
                        @endif
                    </tr>
                </tbody>
            </table> 
            </div>
            </div>      
        @endif      
    </div>
</div>
    
@push('css')
<link href="{{asset('assets/node_modules/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/node_modules/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />

<style>
    .imagen-wrapper{
        position: relative;
        padding-bottom: 56.25%
    }

    .image-wrapper img{

        object-fit: cover;
        width: 50%;
        height: 50%;
    }
</style>
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