@extends('customers.customerProfile')
<!-- extiendo de una plantilla -->
@section('m-content')
 <!-- inicia el contenido para la plantilla-->
<!-- inicio variables para hacer conteos -->
@php
    $products = 0;
    $total = 0;
@endphp
    <h1>DETALLE DE FACTURA</h1>
    <table class="">

        <thead>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>CANTIDAD</th>
            <th>TALLA</th>
            <th>COLOR</th>
        </thead>
        <tbody>
            <!-- imprimo la informacion de cada producto de la factura que viene desde el controlador -->
            @forelse ($detalles as $d)
                <tr>
                    <td>{{ $d->id }}</td>
                    <td>{{ $d->nombre }}</td>
                    <td>${{ number_format(intval(round($d->total))) }}</td>
                    <td>{{ $d->cantidad }}</td>
                    <td>{{ $d->talla }}</td>
                    <td>{{ $d->color }}</td>
                     <!-- hago un conteo de los productos y al mismo calculo el total de todo -->
                    @php
                        $products = $products + 1;
                        $total = $total + ($d->cantidad*$d->total);
                    @endphp
                </tr>
            @empty
                     <!-- si no viene ningun dato del controlador se imprime solo este titulo -->
                <h1>DETALLES DE FACTURA NO ENCONTRADOS</h1>
            @endforelse

        </tbody>
    </table>
         <!-- imprimo los detalles de la factura con su valor total de la variable -->
    <div class="info_fact">
        <div>
            <h2>TOTAL</h2>
            <p id="total_detalles">$ {{ number_format(intval(round($total))) }}</p>
        </div>
        <div>
            <h2>CODIGO DE FACTURA</h2>
            <p>{{ $factura->id }}</p>
        </div>
        <div>
            <h2>CANTIDAD DE PRODUCTOS</h2>
            <p>{{ $products }}</p>
        </div>
        <div>
            <h2>FECHA DE COMPRA</h2>
            <p>{{ $factura->fecha }}</p>
        </div>
        <a href="{{ route('shoppinghistory') }}">VOLVER</a>

    </div>
     <!-- finaliza el contenido para la plantilla-->
@endsection
