<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Reporte de Pedidos</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item active">Reporte de Pedidos</li>
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
                            <li class="nav-item"> <a class="nav-link @if($tab == 'all') active @endif" data-toggle="tab" href="javascript(0)" wire:click="$set('tab', 'all')" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Todos</span> </a> </li>
                            <li class="nav-item"> <a class="nav-link @if($tab == 'aproved') active @endif" data-toggle="tab" href="javascript(0)" wire:click="$set('tab', 'aproved')" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Entregados</span></a> </li>
                            <li class="nav-item"> <a class="nav-link @if($tab == 'canceled') active @endif" data-toggle="tab" href="javascript(0)" wire:click="$set('tab', 'canceled')" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Cancelados</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            @if ($tab == 'all')
                            <div class="tab-pane @if($tab == 'all') active @endif" role="tabpanel">
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
                                                            <input type="date" name="day1" class="form-control" placeholder="dd/mm/yyyy" required>
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
                                                            <input type="date" class="form-control" name="start1" required/>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-info b-0 text-white">Hasta</span>
                                                            </div>
                                                            <input type="date" class="form-control" name="end1" required/>
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
                            @elseif($tab == 'aproved')
                            <div class="tab-pane @if($tab == 'aproved') active @endif" role="tabpanel">
                                <p class="mb-5 font-weight-normal">Generar Reporte de todos los Pedidos Aprobados</p>                                 
                                <div class="row pl-5">
                                    <div class="col-md-12">                      
                                        <div class="d-flex">
                                            <div class="custom-control custom-radio flex-1 mr-4">
                                                <input type="radio" id="dia1" wire:model="panel1" value="dia1" class="custom-control-input">
                                                <label class="custom-control-label" for="dia">Día</label>
                                            </div>
                                            <div class="custom-control custom-radio flex-1 mr-4">
                                                <input type="radio" id="mes1" wire:model="panel1" value="mes1" class="custom-control-input">
                                                <label class="custom-control-label" for="mes1">Mes</label>
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
                                                <form action="{{ route('admin.allordersaprovedday.pdf') }}" method="GET">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="date" name="dia2" class="form-control" placeholder="dd/mm/yyyy" required>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-success">Generar</button>
                                                    </div>
                                                </form>    
                                            </div>
                                            
                                            @elseif ($panel1 == "mes1")
                                            <div class="container p-20">
                                                <form action="{{ route('admin.allordersaprovedmonth.pdf') }}" method="GET">
                                                    <div class="form-group row">
                                                        <div class="col">
                                                        <select name="mes2" class="form-control form-control-select" required>
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
                                                            <select name="years2" class="form-control form-control-select" required>
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
                                                <form action="{{ route('admin.allordersaprovedrange.pdf') }}" method="GET">                
                                                    <div class="form-group">
                                                        <div class="input-group" >
                                                            <input type="date" class="form-control" name="start2" required/>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-info b-0 text-white">Hasta</span>
                                                            </div>
                                                            <input type="date" class="form-control" name="end2" required/>
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
                            @elseif($tab == 'canceled')
                            <div class="tab-pane @if($tab == 'canceled') active @endif" role="tabpanel">
                                <p class="mb-5 font-weight-normal">Generar Reporte de todos los Pedidos Cancelados</p>                                  
                                <div class="row pl-5">
                                    <div class="col-md-12">                  
                                        <div class="d-flex">
                                            <div class="custom-control custom-radio flex-1 mr-4">
                                                <input type="radio" id="dia2" wire:model="panel2" value="dia2" class="custom-control-input">
                                                <label class="custom-control-label" for="dia2">Día</label>
                                            </div>
                                            <div class="custom-control custom-radio flex-1 mr-4">
                                                <input type="radio" id="mes2" wire:model="panel2" value="mes2" class="custom-control-input">
                                                <label class="custom-control-label" for="mes2">Mes</label>
                                            </div>
                                            <div class="custom-control custom-radio flex-1">
                                                <input type="radio" id="range2" wire:model="panel2" value="range2" class="custom-control-input">
                                                <label class="custom-control-label" for="range2">Rango de Fechas</label>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="d-flex justify-content-center">
                                            
                                            @if ($panel2 == "dia2")
                                            <div class="container p-20">
                                                <form action="{{ route('admin.allorderscanceledday.pdf') }}" method="GET">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="date" name="day3" class="form-control" placeholder="dd/mm/yyyy" required>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-success">Generar</button>
                                                    </div>
                                                </form>    
                                            </div>
                                            
                                            @elseif ($panel2 == "mes2")
                                            <div class="container p-20">
                                                <form action="{{ route('admin.allorderscanceledmonth.pdf') }}" method="GET">
                                                    <div class="form-group row">
                                                        <div class="col">
                                                        <select name="mes3" class="form-control form-control-select" required>
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
                                                            <select name="years3" class="form-control form-control-select" required>
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
                                                <form action="{{ route('admin.allorderscanceledrange.pdf') }}" method="GET">                
                                                    <div class="form-group">
                                                        <div class="input-group" >
                                                            <input type="date" class="form-control" name="start3" required />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-info b-0 text-white">Hasta</span>
                                                            </div>
                                                            <input type="date" class="form-control" name="end3" required />
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
                            @endif
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
