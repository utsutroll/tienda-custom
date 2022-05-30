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
                    <li class="breadcrumb-item active">Nuevo Producto</li>
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
                    <h4 class="card-title">Registrar Producto</h4>
                    <h6 class="card-subtitle">Sigue los pasos para registrar un producto</h6>
                    {!! Form::open(['route' => 'admin.products.store', 'autocomplete' => 'off', 'files' => true]) !!}    
                        
                        @include('admin.products.partials.form')

                        <hr/>

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
    
    function multiplicarInputs(text){
        var num= text.value
        var div='';
        for (var i=0;i<num;i++){ 
            var cont=i+1;
            div+='<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"><div class="form-group">{!! Form::label('caracteristica', 'Característica') !!}{!! Form::select('characteristic[]', $characteristics, null, ['class' => 'form-control select22', 'style' => 'width: 100%;', 'id' => '' ]) !!}</div></div><div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"><div class="form-group">{!! Form::label('image', 'Imagen segun la característica del Producto') !!}{!! Form::file('image[]', ['class' => 'form-control', 'accept' => 'image' ]) !!}@error('file')<small class="text-danger">{{$message}}</small>@enderror</div></div>';
        }

      document.getElementById("divMultiInputs").innerHTML=div;

      $(".select22").select2({
        width: 'resolve'
      });

    }

    $(document).ready(function() {

        $('#category_id').on('change', function() {
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
    });

    $(document).ready(function() {
        
        $('#activar').change(function(){ 
            if(this.checked) $('#caracter').fadeIn('slow');

            else $('#caracter').fadeOut('slow'); 

        });
    });

    </script>
@endpush    