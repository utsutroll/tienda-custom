<div class="row">
    <div class="col-6">

        <div class="form-group">
            {!! Form::label('name', 'Aliado Comercial') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Aliado Comercial']) !!} 
            
            @error('name')
                <small class="text-danger">{{$message}}</small>   
            @enderror

        </div>

        <div class="form-group">
            {!! Form::label('link', 'Enlace') !!}
            {!! Form::text('link', null, ['class'=> 'form-control', 'placeholder' => 'Ingrese la Url del sitio Web']) !!}
            
            @error('link')
                <small class="text-danger">{{$message}}</small>   
            @enderror

        </div>

        @if (isset($business_partner) == 0)
        <div class="form-group">
            {!! Form::label('continue', 'Realizar otro Registro') !!}<br/>
            <input type="checkbox" name="continue" checked class="js-switch" data-color="#009efb" />
        </div>    
        @endif
        
    </div>

    <div class="col-6">
        @isset($business_partner->img)
            <div class="form-group">
                <label for="">Imagen que se mostrará en el Slider</label>
                <div class="image-wrapper d-flex justify-content-center">
                    <img id="picture" src="{{Storage::url($business_partner->img)}}">
                </div>
            </div>
            <div class="form-group">
                <input type="file" name="file" id="file" class="form-control"/>
            </div>
            
        @else
        <div class="form-group">
            {!! Form::label('file', 'Imagen que se mostrará en el Slider') !!}
            {!! Form::file('file', ['class' => 'dropify', 'accept' => 'image/*' ]) !!}
            @endisset

            @error('file')
                <small class="text-danger">{{$message}}</small>   
            @enderror
        </div>
    </div>
</div>