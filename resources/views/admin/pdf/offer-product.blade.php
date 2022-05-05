<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock de Productos | La Mega Teinda Turén</title>
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
            <div class="card-title text-center">Productos en Oferta - {{ $date->format('d-m-Y h:m:s') }}</div>

            <div class="card-subtitle text-center m-t-4">Fecha de Culminación - {{ $sale->sale_date }}</div>

            <div class="table-responsive m-t-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="8%">Id</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Pecio de Oferta</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($products as $product)
                        <tr>
                            <td width="8%">{{ $p->id }}</td>
                            <td>{{ $p->name }} {{ $p->presentation->name }} {{ $p->presentation->medida }}</td>
                            <td>{{ $p->price }}$</td>
                            <td>{{ $p->sale_price }}$</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>