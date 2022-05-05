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
            {!! Form::label('category_id', 'Categoría') !!}
            {!! Form::select('category_id', $categories, null, ['class'=> 'form-control']) !!}
            
            @error('category_id')
                <small class="text-danger">{{$message}}</small>   
            @enderror
            
        </div>

        <div class="form-group">
            {!! Form::label('tags', 'Etiquetas') !!}
            {!! Form::select('tags[]', $tags, null, ['class'=> 'form-control select2 select2-multiple', 'style' => 'width: 100%;', 'multiple' => 'multiple', 'data-placeholder' => 'Seleccione' ]) !!}
            
            @error('tags')
                <small class="text-danger">{{$message}}</small>   
            @enderror
            
        </div>

        <div class="form-group">
            
            {!! Form::label('presentation_id', 'Presentación') !!}
            {!! Form::select('presentation_id', $presents, null, ['class' => 'form-control']) !!} 


            @error('presentation_id')
                <small class="text-danger">{{$message}}</small>   
            @enderror

        </div>
        @if (isset($product) == 0)
        <div class="form-group">
            {!! Form::label('continue', 'Realizar otro Registro') !!}<br/>
            <input type="checkbox" name="continue" checked class="js-switch" data-color="#009efb" />
        </div>    
        @endif
        
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