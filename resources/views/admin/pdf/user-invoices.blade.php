<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inversiones Meka C.A</title>

    <link rel="stylesheet" href="{{ asset('css/invoices.css') }}">
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('dist/new/img/logos/logo-meka.svg') }}">
      </div>
      <h1>Factura #{{ $order->id }}</h1>
      <div id="company" class="clearfix">
        <div>Inversiones Meka C.A</div>
        <div>J-407833898</div>
        <div>Av. Ricardo Pérez Zambrano.<br>
          Frente a la plazoleta el Samán al lado de la Panadería El Tigre<br>
          Edif. Hermanos Nimer</div>
        <div><a href="mailto:inversiones.meka@hotmail.com">inversiones.meka@hotmail.com</a></div>
      </div>
          
      <div id="project">
        <div><span>CLIENTE</span> {{ $order->users->name }} {{ $order->users->lastname }}</div>
        <div><span>CORREO</span> <a href="mailto:{{ $order->users->email }}">{{ $order->users->email }}</a></div>
        <div><span>ENTREGAR A</span> {{ $order->firstname }} {{ $order->lastname }}</div>
        <div><span>TELEFONO</span> {{ $order->mobile }}</div>
        <div><span>FECHA</span> {{ $order->delivered_date }}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="desc">PRODUCTO</th>
            <th>PRECIO</th>
            <th>CANTIDAD</th>
            <th>SUBTOTAL</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($order->characteristic_product_order as $item)
          <tr>
            <td class="desc">{{ $item->characteristic_product->product->name }} {{ $item->characteristic_product->product->brand->name }} {{ $item->characteristic_product->characteristic->name }}</td>
            <td class="unit">@foreach  ($dollar as $d) {{ round(($item->price*$d->price),2) }} @endforeach Bs</td>
            <td class="qty">{{ $item->quantity }}</td>
            <td class="total">@foreach  ($dollar as $d) {{ round(($item->price*$item->quantity*$d->price),2) }} @endforeach Bs</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="3" class="grand total">TOTAL</td>
            <td class="grand total">{{ number_format(round($order->total_bs,2),2)}} Bs</td>
          </tr>
        </tbody>
      </table>
    </main>
    <footer>
      Inversiones Meka C.A J407833898 | 2022 Todos los Derechos Reservados <br>Web Elaborada por <a href="https://instagram.com/spacedigitalsolitions" target="_blank">SpaceDigital Solucions C.A</a>
    </footer>
  </body>
</html>