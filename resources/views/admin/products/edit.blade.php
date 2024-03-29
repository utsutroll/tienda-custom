@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Nuevo Producto</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Menú Principal</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">Listado de Productos</a></li>
                    <li class="breadcrumb-item active">Editar Producto</li>
                </ol> 
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- Column -->      
    <!-- Validation wizard -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Editar Producto</h4>
                    <h6 class="card-subtitle"></h6>
                    {!! Form::model($product,['route' => ['admin.products.update', $product], 'method' => 'put', 'autocomplete' => 'off', 'files' => true]) !!}    
                        
                        @include('admin.products.partials.form')

                        <div class="form-group d-flex justify-content-end">
                            <div class="mr-3">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-info']) !!}
                            </div>    
                        </div>   
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
    <link href="{{asset('assets/node_modules/switchery/dist/switchery.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/node_modules/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/node_modules/dropify/dist/css/dropify.min.css')}}" rel="stylesheet">

    <style>
        .imagen-wrapper{
            position: relative;
            padding-bottom: 56.25%
        }

        .image-wrapper img{

            object-fit: cover;
            width: 50%;
            height: 50%;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{asset('assets/node_modules/switchery/dist/switchery.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/multiselect/js/jquery.multi-select.js')}}" type="text/javascript"></script>
    <!-- jQuery file upload -->
    <script src="{{asset('assets/node_modules/dropify/dist/js/dropify.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">

    $('#liProducts').addClass("active");
    $(".select2").select2({
        width: 'resolve'
    });

    $('.dropify').dropify({
        messages: {
            default: 'Arrastre y suelte un archivo aquí o haga clic',
            replace: 'Arrastre y suelte un archivo o haga clic para sustituirlo',
            remove: 'Remover',
            error: 'Lo siento, el archivo es demasiado grande'
        }
    });
    @if (session('info'))
        $.toast({
            heading: 'Notificación',
            text: '{{session('info')}}',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          }); 
    @endif  

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
    }); 

    document.getElementById("file").addEventListener('change', cambiarImagen);

    function cambiarImagen(event) {
        var file = event.target.files[0];

        var reader = new FileReader();
        reader.onload = (event) => {
            document.getElementById("picture").setAttribute('src', event.target.result);
        };

        reader.readAsDataURL(file);
    }     
    
    function multiplicarInputs(text){
        var num= text.value
        var div='';
        for (var i=0;i<num;i++){ 
            var cont=i+1;
            div+='<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"><div class="form-group">{!! Form::label('caracteristica', 'Característica') !!}{!! Form::select('charact[]', $characteristics, null, ['class' => 'form-control select22', 'style' => 'width: 100%;', 'id' => '' ]) !!}</div></div><div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"><div class="form-group">{!! Form::label('image', 'Imagen segun la característica del Producto') !!}{!! Form::file('imge[]', ['class' => 'form-control', 'accept' => "image/*" ]) !!}@error('file')<small class="text-danger">{{$message}}</small>@enderror</div></div>';
        }

        document.getElementById("divMultiInputs").innerHTML=div;

        $(".select22").select2({
            width: 'resolve'
        });
    }
    $(document).ready(function() {
        
        /* $('#category_id').on('selected', function() {
            var dato = $('#category_id').val();

        }); */

        $('select[name="category_id"]').on('change', function() {
            $('#subcategory_id').append('<option hidden>Seleccione</option>');
            var categoryID = $(this).val();
            if(categoryID) {
                $.ajax({
                    url: '/select/'+categoryID,
                    type: "GET",
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data){
                    if(data){
                        $('#subcategory_id').empty();
                        $('#subcategory_id').append('<option hidden>Seleccione</option>'); 
                        $.each(data, function(key, subcategories){

                            $('select[name="subcategory_id"]').append('<option value="'+ subcategories.id +'">' + subcategories.name + '</option>');
                        });
                    }else{
                        $('#subcategory_id').empty();
                    }
                }
                });
            }else{
                $('#subcategory_id').empty();
            }
        });

        $('#delete_id').on('click', function (event) {
            var button = $(event.relatedTarget) 
            var char_id = button.data('charid') 
            $.ajax({
                url: '/delete_char/'+char_id,
                type: "post",
                data : {"_token":"{{ csrf_token() }}"},
                success:function(data){
                    $.toast({
                        heading: 'Notificación',
                        text: 'Eliminado con exito',
                        position: 'top-right',
                        loaderBg:'#ff6849',
                        icon: 'success',
                        hideAfter: 3500, 
                        stack: 6
                    });
                }
            });        
        });
    });

    $(document).ready(function() {
        
        $('#activar').change(function(){ 
            if(this.checked) $('#caracter').fadeIn('slow');

            else $('#caracter').fadeOut('slow'); 

        });
    });
    

    window.livewire.on('CharDeleted',()=>{

        $.toast({
            heading: 'Notificación',
            text: 'La característica se eliminó con éxito.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'info',
            hideAfter: 3500, 
            stack: 6
        });
        });

        window.livewire.on('CharDeleted_e',()=>{

        $.toast({
            heading: 'Notificación',
            text: 'La característica se encuetra asignado a una Entrada, no puede ser eliminado.',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 3500, 
            stack: 6
        });

    });
    </script>
@endpush    