@extends('customers.customerProfile')
    <!-- extiendo de la plantilla -->
@section('m-content')
    <!-- inicia el contenido para la plantilla-->
    <!-- inicio variables para hacer conteos -->
@php
    $total = 0;
    $facts = 0;
@endphp
<h1>FACTURAS</h1>
<table class="">

    <thead>
        <th>ID</th>
        <th>TOTAL</th>
        <th>FECHA</th>
        <th>ACCION</th>

    </thead>
    <tbody>
        <!-- imprimo la informacion de la factura que viene desde el controlador -->
        @forelse ($factura as $f)
        <tr>
            <td>{{ $f->id }}</td>
            <td>${{ number_format(intval(round($f->total))) }}</td>
            <td>{{ $f->fecha }}</td>
                    <!-- calculamos la cantidad de facturas y el total de totas-->
            @php
                $total = $total + $f->total;
                $facts = $facts + 1;
            @endphp
            <td><a class="btn btn-success btn-sm" href="{{ route('InvoiceDetails', $f->id) }}">VER DETALLE</a></td>
        </tr>
        @empty
           <!-- si no viene ninguna informacion se imprime solo eso-->
        <h1>No tienes compras realizadas</h1>
    @endforelse

    </tbody>
</table>
        <!-- se imprime el calculo de todas las facturas con la cantidad de facturas-->
<div class="info_fact">
    <div>
        <h2>TOTAL INVERTIDO</h2>
        <p id="total_detalles">$ {{ number_format(intval(round($total))) }}</p>
    </div>

    <div>
        <h2>CANTIDAD DE FACTURAS</h2>
        <p>{{ $facts }}</p>
    </div>
</div>

 <!-- finaliza el contenido para la plantilla-->
@endsection
