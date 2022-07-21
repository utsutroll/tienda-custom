<div class="row">
    <div class="col-12">
        <div class="row p-4">
        @foreach ($product->characteristics_product as $c )
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="form-group">
                
                {!! Form::label('caracteristica', 'Característica') !!}
                
                <select name="characteristic[]" class="form-control select2" value="{{ old('characteristic[]') }}" style ="width: 100%;">
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
                <label for="">Imágen según la característica del Producto</label>
                <div class="image-wrapper d-flex justify-content-center">
                    <img id="pictures" src="{{ Storage::url($c->image) }}">
                </div>
            </div>
            <div class="form-group">
                <input type="file" name="image[]" id="image" value="{{ old('image[]') }}" class="form-control"/>
            </div>
        </div>
        <div class="col-2">
            <a class="btn btn-danger btn-block" wire:click.prevent="delete({{ $c->id }})" wire:loading.disabled wire:target="delete">Eliminar</a> 
        </div>
        @endforeach
        </div>
    </div>
</div>
