<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Listado de Usuarios</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Listado de Usuarios</li>
                </ol>
                <button type="button" class="btn btn-success btn-md float-right m-l-15" data-toggle="modal" data-target="#create-modal" wire:click='create'><i class="fa fa-plus-circle"></i> Nuevo Usuario</button>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    @include("livewire.admin.partials.$view")

    @include('livewire.admin.partials.editUser')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Usuario</h4>
            <h6 class="card-subtitle"></h6>
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
                        @if ($search !== '')
                        <button class="btn btn-outline-secondary btn-sm waves-effect waves-light" wire:click="clear" type="button"><span class="btn-label"><i class="fa fa-times"></i></span></button>    
                        @endif
                        
                    </label>
                </div>
    
            </div>
            
            <div class="table-responsive m-t-2">
                @if (count($users) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th wire:click="order('id')" style="cursor:pointer;">ID
                                {{-- Sort --}}
                                @if ($sort == 'id')
                                    @if ($direcction == 'asc')
                                        <i class="fa fa-sort-numeric-asc float-right mt-1"></i>    
                                    @else
                                        <i class="fa fa-sort-numeric-desc float-right mt-1"></i>    
                                    @endif
                                    
                                @else
                                    <i class="fa fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th wire:click="order('name')" style="cursor:pointer;">Nombre
                                {{-- Sort --}}
                                @if ($sort == 'name')
                                    @if ($direcction == 'asc')
                                        <i class="fa fa-sort-alpha-asc float-right mt-1"></i>    
                                    @else
                                        <i class="fa fa-sort-alpha-desc float-right mt-1"></i>    
                                    @endif
                                    
                                @else
                                    <i class="fa fa-sort float-right mt-1"></i>
                                @endif
                                
                            </th>
                            <th wire:click="order('email')" style="cursor:pointer;">Correo
                                {{-- Sort --}}
                                @if ($sort == 'email')
                                    @if ($direcction == 'asc')
                                        <i class="fa fa-sort-alpha-asc float-right mt-1"></i>    
                                    @else
                                        <i class="fa fa-sort-alpha-desc float-right mt-1"></i>    
                                    @endif
                                    
                                @else
                                    <i class="fa fa-sort float-right mt-1"></i>
                                @endif
                                
                            </th>
                            <th colspan="2" class="text-nowrap">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($users as $u)
                           
                        <tr>
                            <td width="8%">{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
    
                            <td width="10px" class="text-nowrap">
                                <button 
                                    class="btn btn-info btn-sm"
                                    data-toggle="modal" data-target="#edit-modal"
                                    wire:click="edit({{$u->id}})">
                                    <i class="ti-pencil"></i> 
                                    Editar
                                </button>
                            </td>
                            <td width="10px" class="text-nowrap">
                                <button 
                                    class="btn btn-danger btn-sm"
                                    wire:click="destroy({{$u->id}})"> 
                                    Desactivar
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
                {{$users->links()}}
            </div>
        </div> 
        @elseif (count($users) == 0 & $search !== '')
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
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th colspan="2" class="text-nowrap">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td colspan="4">No se Encontraron Registros</td>
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

    $('#liUser').addClass("active");

    window.livewire.on('userAdded',()=>{
        $('#create-modal').modal('hide');

        $.toast({
            heading: 'Notificación',
            text: 'El Usuario se creó con éxito.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          });
    });

    window.livewire.on('userEdited',()=>{
        $('#edit-modal').modal('hide');

        $.toast({
            heading: 'Notificación',
            text: 'El Usuario se actualizó con éxito.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          });
    });
    window.livewire.on('userDeleted',()=>{

        $.toast({
            heading: 'Notificación',
            text: 'El Usuario se desactivó con éxito.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'info',
            hideAfter: 3500, 
            stack: 6
          });
    });
    window.livewire.on('userDeleted_e',()=>{

        $.toast({
            heading: 'Notificación',
            text: 'El Usuario, no puede ser desactivó.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 3500, 
            stack: 6
          });
    });

    </script>
    @endpush
</div>
