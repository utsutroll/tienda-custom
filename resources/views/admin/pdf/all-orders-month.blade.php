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
            <div class="card-title text-center font-weight-bold">Todos los Pedidos - {{ $date->format('d-m-Y h:m:s') }}</div>

            <div class="table-responsive m-t-2">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="8%">ID</th>
                            <th width="30%">Cliente</th>
                            <th>Total $</th>
                            <th>Total Bs</th>
                            <th>Estatus</th>
                        </tr> 
                    </thead>
                    <tbody>
                        
                        @foreach ($products as $p)
                        <tr>
                            <td width="8%">{{ $p->id }}</td>
                            <td  width="30%">C.I: {{ $p->cedula }} {{ $p->firstname }} {{ $p->lastname }}</td>
                            <td>{{ $p->total }}</td>
                            <td>{{ $p->total_bs }}</td>
                            <td>{{ $p->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>