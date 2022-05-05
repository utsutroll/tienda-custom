<div class="d-flex justify-content-end">
    <div class="form-group">
        <label for="" class="d-flex justify-content-end">Fecha de Entrada</label>
        <input type="text" class="form-control" value="{{ $date->format('d-m-Y') }} - {{ $date->format('H:i') }}" disabled="">
        {!! Form::date('date', $date->format('d/m/Y'), ['hidden']) !!}
        <input type="time" name="time" value="{{ $date->format('H:i') }}" hidden>
    </div>
</div>                                                    

<hr>
<div class="row">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <div class="form-group">
            
            {!! Form::label('product', 'Producto') !!}
            {!! Form::select('product', $product, null, ['class' => 'form-control', 'style' => 'width: 100%;', 'placeholder' ]) !!} 

        </div>
    </div>
        
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <div class="form-group">

            {!! Form::label('pquantity', 'Cantidad') !!}
            {!! Form::number('pquantity', null, ['class' => 'form-control', 'min' => '1', 'placeholder' => 'Ingrese la cantidad']) !!} 
            
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group pt-4 mt-2">
            <label for=""> </label>
            <button type="button" id="bt_add" class="btn btn-primary"> Agregar</button>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
            <thead style="background-color:#A9D0F5;">
                <th>Opciones</th>
                <th colspan="2">Producto</th>
                <th>Cantidad</th>
            </thead>
            <tfoot>
                <tr>

                </tr>
            </tfoot>
            <tbody>
                
            </tbody>
        </table>
    </div> 
</div>
<div class="form-group clearfix">
    {!! Form::label('continue', 'Realizar otro Registro') !!}<br/>
    <input type="checkbox" name="continue" checked class="js-switch" data-color="#009efb" />
</div> 
