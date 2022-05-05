<div>
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Listado de Imagenes Promocionales</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Listado de Imagenes Promocionales</li>
                </ol>
                <a href="{{route('admin.slider.create')}}" class="btn btn-success btn-md float-right m-l-15"><i class="fa fa-plus-circle"></i> Nueva Imagen</a> 
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Imagenes Promocionales</h4>
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
                @if (count($sliders) > 0)
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
                            <th width="20%" wire:click="order('title')" style="cursor:pointer;">Título
                                {{-- Sort --}}
                                @if ($sort == 'title')
                                    @if ($direcction == 'asc')
                                        <i class="fa fa-sort-alpha-asc float-right mt-1"></i>    
                                    @else
                                        <i class="fa fa-sort-alpha-desc float-right mt-1"></i>    
                                    @endif
                                    
                                @else
                                    <i class="fa fa-sort float-right mt-1"></i>
                                @endif
                                
                            </th>
                            <th>Imagen</th>
                            <th colspan="3" class="text-nowrap">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($sliders as $s)
                           
                        <tr>
                            <td width="8%">{{ $s->id }}</td>
                            <td width="20%">{{ $s->title }}</td>
                            <td><img width="20%" src="{{Storage::url($s->image->url) }}" alt="{{ $s->title }}" class="img-thumbnail"></td>
                            
                            <td width="10px" class="text-nowrap">
                                <a 
                                    class="btn btn-info btn-sm"
                                    href="{{route('admin.slider.edit', $s)}}">
                                    <i class="ti-pencil"></i> 
                                    Editar
                                </a>
                            </td>
                            <td width="10px" class="text-nowrap">
                                <a 
                                    class="btn btn-secondary btn-sm"
                                    href="{{route('admin.slider.show', $s)}}">
                                    <i class="ti-eye"></i> 
                                    Ver
                                </a>
                            </td>
                            <td width="10px" class="text-nowrap">
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
                {{$sliders->onEachSide(5)->links()}}
            </div>
        </div> 
        @elseif (count($sliders) == 0 & $search !== '')
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
                        <th>Titulo</th>
                        <th>Imagen</th>
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
</div>