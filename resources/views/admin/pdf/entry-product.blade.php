<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entrada de Productos | Inversiones Meka C.A</title>
    <!-- Custom CSS -->
    <style>
        /*!
        * Bootstrap v4.0.0 (https://getbootstrap.com)
        * Copyright 2011-2018 The Bootstrap Authors
        * Copyright 2011-2018 Twitter, Inc.
        * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
        */
        /*# sourceMappingURL=bootstrap.min.css.map */
    </style>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <div class="card">

        <div class="card-body">
            <div class="card-title text-center font-weight-bold">Listado de entradas de productos - {{ $date->format('d-m-Y h:m:s A') }}</div>

            <div class="table-responsive mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th class="text-center">Fecha de Entrada</th>
                        </tr> 
                    </thead>
                    <tbody>
                        
                        @foreach ($products as $product)
                        <tr>
                            <td width="50%">{{ $product->name }} {{ $product->brand }} {{ $product->char }}</td>
                            <td width="15%" class="text-center">{{ $product->quantity }}</td>
                            <td class="text-center">{{ date('d-m-Y', strtotime($product->date)) }} {{ date('h:i:s A', strtotime($product->time)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>