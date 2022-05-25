@if (session('slug'))
    <div class="alert alert-danger"> <i class="fa fa-exclamation-triangle"></i> {{ session('slug') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
    </div>
@endif
@error('slug')
    <div class="alert alert-danger"> <i class="fa fa-exclamation-triangle"></i> {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
</div>                
@enderror
<div class="row">
    <div class="col-6">
       
        <div class="form-group">
            @if (isset($product) == 0)
                {!! Form::label('id', 'Código') !!}
                {!! Form::number('id', null, ['class' => 'form-control', 'min' => '1', 'placeholder' => 'Ingrese el código del Producto']) !!} 
            
                @error('id')
                    <small class="text-danger">{{$message}}</small>   
                @enderror
            @else
                {!! Form::label('id', 'Código') !!}
                {!! Form::number('id', null, ['class' => 'form-control', 'disabled' => 'true', 'placeholder' => 'Ingrese el código del Producto']) !!} 
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del Producto']) !!} 
            
            @error('name')
                <small class="text-danger">{{$message}}</small>   
            @enderror

        </div>

        <div class="form-group">
            {!! Form::label('brand_id', 'Marca') !!}
            {!! Form::select('brand_id', $brands, 'Selecciones', ['class'=> 'form-control select2', 'data-placeholder' => 'Seleccione']) !!}

            @error('brand_id')
                <small class="text-danger">{{$message}}</small>   
            @enderror
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('category_id', 'Categoría') !!}
                    @isset($product)
                    {!! Form::select('category_id', $categories, 'Selecciones', ['class'=> 'form-control select2', 'id' => 'category_id', 'data-placeholder' => 'Seleccione']) !!}
                    @else
                    {!! Form::select('category_id', $categories, 'Selecciones', ['class'=> 'form-control select2', 'id' => 'category_id', 'placeholder' => 'Seleccione']) !!}
                    @endisset
                    

                    @error('category_id')
                        <small class="text-danger">{{$message}}</small>   
                    @enderror
                    
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="subcategory" class="form-label">Subategoría</label>
                    
                    @isset($product)
                    {!! Form::select('subcategory_id', $subcategories, 'Selecciones', ['class'=> 'form-control select2', 'id' => 'subcategory_id', 'data-placeholder' => 'Seleccione']) !!}    
                    @else
                    <select class="form-control select2" name="subcategory_id" id="subcategory_id">
                    </select>
                    @endisset

                    @error('subcategory_id')
                        <small class="text-danger">{{$message}}</small>   
                    @enderror
                    
                </div>
            </div>
        </div>

    </div>

    <div class="col-6">
        <div class="form-group">
            {!! Form::label('details', 'Detalle') !!}
            {!! Form::textarea('details', null, ['class' => 'form-control', 'rows'=> '6', 'placeholder' => 'Ingrese el detalle del Producto']) !!}
        
            @error('details')
                <small class="text-danger">{{$message}}</small>   
            @enderror
        </div>
        @isset($product->image)
        <div class="form-group">
            <label for="">Imagen que se mostrará del Producto</label>
            <div class="image-wrapper d-flex justify-content-center">
                <img id="picture" src="{{Storage::url($product->image->url)}}">
            </div>
        </div>
        <div class="form-group">
            <input type="file" name="file" id="file" class="form-control"/>
        </div>
            
        @else
        <div class="form-group">
            {!! Form::label('file', 'Imagen que se mostrará del Producto') !!}
            {!! Form::file('file', ['class' => 'dropify', 'accept' => 'image/*' ]) !!}
        @endisset

            @error('file')
                <small class="text-danger">{{$message}}</small>   
            @enderror
        </div>
        
    </div>
</div>

@isset($product)
<hr>
<div class="row">
    <div class="col-12">
        <div class="row p-4">
        @foreach ($product->characteristics_product as $c )
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="form-group">
                
                {!! Form::label('caracteristica', 'Característica') !!}
                
                <select name="characteristic[]" class="form-control select2" style ="width: 100%;">
                    @if ($c->characteristic->characteristic_id == $characteristics)
                    <option selected value="{{ $c->characteristic_id }}">{{ $c->characteristic->name }}</option>
                    @else
                    <option value="{{ $c->characteristic_id }}">{{ $c->characteristic->name }}</option>
                    @endif
                </select>
                @error('characteristic')
                    <small class="text-danger">{{$message}}</small>   
                @enderror
            </div>
        </div>

        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="form-group">
                <label for="">Imagen según la característica del Producto</label>
                <div class="image-wrapper d-flex justify-content-center">
                    <img id="pictures" src="{{ Storage::url($c->image) }}">
                </div>
            </div>
            <div class="form-group">
                <input type="file" name="image[]" id="image" class="form-control"/>
            </div>
        </div>
        @endforeach
        </div>
    </div>
</div>
@endisset



<div class="form-group p-2">
    {!! Form::label('activar', 'Agregar Características') !!}<br/>
    <input type="checkbox" name="activar" id="activar" class='js-switch' data-color='#3d3b3b'>
</div>
<div class="row">
    <div class="col-12">
        <hr>
        <div id="caracter" style="display: none;">
            <div class="form-group col-5">
                <label for="">Número de Características</label>
                <input maxlength="2" class="form-control" name="numInputs" onkeyup="multiplicarInputs(this)" type="text" />
            </div>
            <div class="row p-2">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <div class="form-group">
                        
                        {!! Form::label('caracteristica', 'Característica') !!}
                        {!! Form::select('charact[]', $characteristics, null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => '', 'data-placeholder' => 'Seleccione' ]) !!} 

                        @error('charact')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                </div>
                    
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <div class="form-group">
                        {!! Form::label('image', 'Imagen según la característica del Producto') !!}
                        {!! Form::file('imge[]', ['class' => 'form-control', 'accept' => 'image/*' ]) !!}

                        @error('image')
                            <small class="text-danger">{{$message}}</small>   
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="divMultiInputs">
        </div>
    </div>
</div>

@if (isset($product) == 0)
<hr>
<div class="form-group">
    {!! Form::label('continue', 'Realizar otro Registro') !!}<br/>
    <input type="checkbox" name="continue" checked class="js-switch" data-color="#009efb" />
</div>    
@endif