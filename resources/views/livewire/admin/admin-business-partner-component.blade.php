<div>
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Listado de Aliados Comerciales</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Listado de Aliados Comerciales</li>
                </ol>
                <a href="{{route('admin.business-partners.create')}}" class="btn btn-success btn-md float-right m-l-15"><i class="fa fa-plus-circle"></i> Nuevo Aliado</a> 
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Aliados Comerciales</h4>
            
            <div class="table-responsive m-t-2">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Aliado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partners as $p)
                           
                        <tr>
                            <td width="8%">{{ $p->id }}</td>
                            <td>{{ $p->name }}</td>
                            <td><img width="20%" src="{{Storage::url($p->img) }}" alt="{{ $p->name }}" class="img-thumbnail"></td>
                            
                            <td>
                                <a 
                                    class="btn btn-info btn-sm mr-2"
                                    href="{{route('admin.business-partners.edit', $p)}}">
                                    <i class="ti-pencil"></i> 
                                    Editar
                                </a>

                                <button 
                                    class="btn btn-danger btn-sm"
                                    wire:click="destroy({{$p->id}})">
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
