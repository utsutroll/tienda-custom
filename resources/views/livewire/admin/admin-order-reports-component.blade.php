<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Reporte de Órdenes</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Reporte de Órdenes</li>
                </ol>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>
                    <h6 class="card-subtitle mb-4"></h6>
                    <!-- Nav tabs -->
                    <div class="vtabs customvtab">
                        <ul class="nav nav-tabs tabs-vertical" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#all" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Todas</span> </a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#approved" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Aprobadas</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#canceled" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Canceladas</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="all" role="tabpanel">
                                <p class="mb-5 font-weight-normal">Generar Reporte de todos los Pedidos</p>
                                <div class="row pl-5">
                                    <div class="col-md-12">
                                        <div class="d-flex">
                                            <div class="custom-control custom-radio flex-1 mr-4">
                                                <input type="radio" id="dia" wire:model="panel" value="dia" class="custom-control-input">
                                                <label class="custom-control-label" for="dia">Día</label>
                                            </div>
                                            <div class="custom-control custom-radio flex-1 mr-4">
                                                <input type="radio" id="mes" wire:model="panel" value="mes" class="custom-control-input">
                                                <label class="custom-control-label" for="mes">Mes</label>
                                            </div>
                                            <div class="custom-control custom-radio flex-1">
                                                <input type="radio" id="range" wire:model="panel" value="range" class="custom-control-input">
                                                <label class="custom-control-label" for="range">Rango de Fechas</label>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="d-flex justify-content-center">
                                            
                                            @if ($panel == "dia")
                                            <div class="container p-20">
                                                <form action="{{ route('admin.allordersday.pdf') }}" method="GET">
                                                    @csrf
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="date" name="day1" class="form-control" placeholder="dd/mm/yyyy">
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-success">Generar</button>
                                                    </div>
                                                </form>    
                                            </div>
                                            
                                            @elseif ($panel == "mes")
                                            <div class="container p-20">
                                                <form action="{{ route('admin.allordersmonth.pdf') }}" method="GET">
                                                    <div class="form-group row">
                                                        <div class="col">
                                                        <select name="mes1" class="form-control form-control-select" required>
                                                                <option value="">Mes</option>
                                                                <option value="01">Enero</option>
                                                                <option value="02">Febrero</option>
                                                                <option value="03">Marzo</option>
                                                                <option value="04">Abril</option>
                                                                <option value="05">Mayo</option>
                                                                <option value="06">Junio</option>
                                                                <option value="07">Julio</option>
                                                                <option value="08">Agosto</option>
                                                                <option value="09">Septiembre</option>
                                                                <option value="10">Octubre</option>
                                                                <option value="11">Noviembre</option>
                                                                <option value="12">Diciembre</option>
                                                            </select>
                                                        </div>
                                                        <div class="col">       
                                                            <select name="years1" class="form-control form-control-select" required>
                                                                <option value="">Año</option>
                                                                @php
                                                                    $year=date("Y")
                                                                @endphp
                                                                @for($f=$year-16;$f<=$year;$f++)
                                                                {
                                                                    <option value="{{ $f }}">{{ $f }}</option>
                                                                }
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-success">Generar</button>
                                                    </div>
                                                </form>      
                                            </div>
                                            
                                            @elseif ($panel == "range")
                                            <div class="container p-20">
                                                <form action="{{ route('admin.allordersrange.pdf') }}" method="GET">                
                                                    <div class="form-group">
                                                        <div class="input-group" >
                                                            <input type="date" class="form-control" name="start1" />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-info b-0 text-white">Hasta</span>
                                                            </div>
                                                            <input type="date" class="form-control" name="end1" />
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-success">Generar</button>
                                                    </div>
                                                </form>                      
                                            </div>
                                            @endif
                                        </div>
                                     </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="approved" role="tabpanel">
                                <p class="mb-5 font-weight-normal">Generar Reporte de todos los órdenes</p>                                 
                                <div class="row pl-5">
                                    <div class="col-md-12">                      
                                        <div class="d-flex">
                                            <div class="custom-control custom-radio flex-1 mr-4">
                                                <input type="radio" id="dia1" wire:model="panel1" value="dia1" class="custom-control-input">
                                                <label class="custom-control-label" for="dia">Día</label>
                                            </div>
                                            <div class="custom-control custom-radio flex-1 mr-4">
                                                <input type="radio" id="mes1" wire:model="panel1" value="mes1" class="custom-control-input">
                                                <label class="custom-control-label" for="mes">Mes</label>
                                            </div>
                                            <div class="custom-control custom-radio flex-1">
                                                <input type="radio" id="range1" wire:model="panel1" value="range1" class="custom-control-input">
                                                <label class="custom-control-label" for="range1">Rango de Fechas</label>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="d-flex justify-content-center">
                                            
                                            @if ($panel1 == "dia1")
                                            <div class="container p-20">
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="date" class="form-control" placeholder="dd/mm/yyyy">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-success">Generar</button>
                                                    </div>
                                                </form>    
                                            </div>
                                            
                                            @elseif ($panel1 == "mes1")
                                            <div class="container p-20">
                                                <form action="" method="POST">
                                                    <div class="form-group row">
                                                        <div class="col">
                                                        <select name="mes" class="form-control form-control-select" required>
                                                                <option value="">Mes</option>
                                                                <option value="01">Enero</option>
                                                                <option value="02">Febrero</option>
                                                                <option value="03">Marzo</option>
                                                                <option value="04">Abril</option>
                                                                <option value="05">Mayo</option>
                                                                <option value="06">Junio</option>
                                                                <option value="07">Julio</option>
                                                                <option value="08">Agosto</option>
                                                                <option value="09">Septiembre</option>
                                                                <option value="10">Octubre</option>
                                                                <option value="11">Noviembre</option>
                                                                <option value="12">Diciembre</option>
                                                            </select>
                                                        </div>
                                                        <div class="col">       
                                                            <select name="years" class="form-control form-control-select" required>
                                                                <option value="">Año</option>
                                                                @php
                                                                    $year=date("Y")
                                                                @endphp
                                                                @for($f=$year-16;$f<=$year;$f++)
                                                                {
                                                                    <option value="{{ $f }}">{{ $f }}</option>
                                                                }
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-success">Generar</button>
                                                    </div>
                                                </form>      
                                            </div>
                                            
                                            @elseif ($panel1 == "range1")
                                            <div class="container p-20">
                                                <form action="" method="POST">                
                                                    <div class="form-group">
                                                        <div class="input-group" >
                                                            <input type="date" class="form-control" name="start" />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-info b-0 text-white">Hasta</span>
                                                            </div>
                                                            <input type="date" class="form-control" name="end" />
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-success">Generar</button>
                                                    </div>
                                                </form>                      
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>                                    
                            </div>
                            <div class="tab-pane" id="canceled" role="tabpanel">
                                <p class="mb-5 font-weight-normal">Generar Reporte de todos los órdenes</p>                                  
                                <div class="row pl-5">
                                    <div class="col-md-12">                  
                                        <div class="d-flex">
                                            <div class="custom-control custom-radio flex-1 mr-4">
                                                <input type="radio" id="dias" wire:model="panels" value="dias" class="custom-control-input">
                                                <label class="custom-control-label" for="dias">Día</label>
                                            </div>
                                            <div class="custom-control custom-radio flex-1 mr-4">
                                                <input type="radio" id="mess" wire:model="panel" value="mess" class="custom-control-input">
                                                <label class="custom-control-label" for="mes">Mes</label>
                                            </div>
                                            <div class="custom-control custom-radio flex-1">
                                                <input type="radio" id="ranges" wire:model="panel" value="ranges" class="custom-control-input">
                                                <label class="custom-control-label" for="ranges">Rango de Fechas</label>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="d-flex justify-content-center">
                                            
                                            @if ($panel2 == "dia2")
                                            <div class="container p-20">
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="date" class="form-control" placeholder="dd/mm/yyyy">
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-success">Generar</button>
                                                    </div>
                                                </form>    
                                            </div>
                                            
                                            @elseif ($panel2 == "mes2")
                                            <div class="container p-20">
                                                <form action="" method="POST">
                                                    <div class="form-group row">
                                                        <div class="col">
                                                        <select name="mes" class="form-control form-control-select" required>
                                                                <option value="">Mes</option>
                                                                <option value="01">Enero</option>
                                                                <option value="02">Febrero</option>
                                                                <option value="03">Marzo</option>
                                                                <option value="04">Abril</option>
                                                                <option value="05">Mayo</option>
                                                                <option value="06">Junio</option>
                                                                <option value="07">Julio</option>
                                                                <option value="08">Agosto</option>
                                                                <option value="09">Septiembre</option>
                                                                <option value="10">Octubre</option>
                                                                <option value="11">Noviembre</option>
                                                                <option value="12">Diciembre</option>
                                                            </select>
                                                        </div>
                                                        <div class="col">       
                                                            <select name="years" class="form-control form-control-select" required>
                                                                <option value="">Año</option>
                                                                @php
                                                                    $year=date("Y")
                                                                @endphp
                                                                @for($f=$year-16;$f<=$year;$f++)
                                                                {
                                                                    <option value="{{ $f }}">{{ $f }}</option>
                                                                }
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-success">Generar</button>
                                                    </div>
                                                </form>      
                                            </div>
                                            
                                            @elseif ($panel2 == "range2")
                                            <div class="container p-20">
                                                <form action="" method="POST">                
                                                    <div class="form-group">
                                                        <div class="input-group" >
                                                            <input type="date" class="form-control" name="start" />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-info b-0 text-white">Hasta</span>
                                                            </div>
                                                            <input type="date" class="form-control" name="end" />
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-success">Generar</button>
                                                    </div>
                                                </form>                      
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                  
    </div> 
</div>
@push('css')
    <!-- page css -->
    <link href="{{ asset('dist/css/pages/tab-page.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script>
        $('#LiOrderReports').addClass('active');
    </script>
@endpush
