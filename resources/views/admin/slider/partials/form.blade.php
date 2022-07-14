<div class="row">
    <div class="col-6">

        <div class="form-group">
            {!! Form::label('title', 'Título') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Título de la Promoción']) !!} 
            
            @error('title')
                <small class="text-danger">{{$message}}</small>   
            @enderror

        </div>

        <div class="form-group">
            {!! Form::label('subtitle', 'SubTítulo') !!}
            {!! Form::text('subtitle', null, ['class'=> 'form-control', 'placeholder' => 'Ingrese el SubTítulo de la Promoción']) !!}
            
            @error('subtitle')
                <small class="text-danger">{{$message}}</small>   
            @enderror
            
        </div>

        <div class="form-group">
            {!! Form::label('link', 'Enlace') !!}
            {!! Form::text('link', null, ['class'=> 'form-control', 'placeholder' => 'Ingrese un Enlace de la Promoción (Opcional)']) !!}
            
        </div>

        @if (isset($slider) == 0)
        <div class="form-group">
            {!! Form::label('continue', 'Realizar otro Registro') !!}<br/>
            <input type="checkbox" name="continue" checked class="js-switch" data-color="#009efb" />
        </div>    
        @endif
        
    </div>

    <div class="col-6">
        <div class="form-group">
            {!! Form::label('detail', 'Detalle') !!}
            {!! Form::textarea('detail', null, ['class' => 'form-control', 'rows'=> '6', 'placeholder' => 'Ingrese el detalle de la Promoción']) !!}
        
            @error('detail')
                <small class="text-danger">{{$message}}</small>   
            @enderror
        </div>
        @isset($slider->image)
            <div class="form-group">
                <label for="">Imágen que se mostrará en el Slider</label>
                <div class="image-wrapper d-flex justify-content-center">
                    <img id="picture" src="{{Storage::url($slider->image->url)}}">
                </div>
            </div>
            <div class="form-group">
                <input type="file" name="file" id="file" class="form-control"/>
            </div>
            
        @else
        <div class="form-group">
            {!! Form::label('file', 'Imágen que se mostrará en el Slider') !!}
            {!! Form::file('file', ['class' => 'dropify', 'accept' => 'image/*' ]) !!}
            @endisset

            @error('file')
                <small class="text-danger">{{$message}}</small>   
            @enderror
        </div>
    </div>
</div>