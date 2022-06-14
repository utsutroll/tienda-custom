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

            <div class="table-responsive m-t-2">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Imagen</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $s)
                           
                        <tr>
                            <td width="8%">{{ $s->id }}</td>
                            <td width="20%">{{ $s->title }}</td>
                            <td><img width="20%" src="{{Storage::url($s->image->url) }}" alt="{{ $s->title }}" class="img-thumbnail"></td>
                            
                            <td width="30%">
                                <a 
                                    class="btn btn-info btn-sm mr-2"
                                    href="{{route('admin.slider.edit', $s)}}">
                                    <i class="ti-pencil"></i> 
                                    Editar
                                </a>

                                <a 
                                    class="btn btn-secondary btn-sm mr-2"
                                    href="{{route('admin.slider.show', $s)}}">
                                    <i class="ti-eye"></i> 
                                    Ver
                                </a>

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