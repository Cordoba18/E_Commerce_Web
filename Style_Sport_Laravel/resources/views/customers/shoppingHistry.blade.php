@extends('customers.customerProfile')

@section('m-content')

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
        @forelse ($factura as $f)
        <tr>
            <td>{{ $f->id }}</td>
            <td>${{ number_format(intval(round($f->total))) }}</td>
            <td>{{ $f->fecha }}</td>
            @php
                $total = $total + $f->total;
                $facts = $facts + 1;
            @endphp
            <td><a class="btn btn-success btn-sm" href="{{ route('InvoiceDetails', $f->id) }}">VER DETALLE</a></td>
        </tr>
        @empty
        <h1>No tienes compras realizadas</h1>
    @endforelse

    </tbody>
</table>
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


@endsection
