@extends('customers.customerProfile')

@section('m-content')


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
            <td>${{ $f->total }}</td>
            <td>{{ $f->fecha }}</td>
            <td><a class="btn btn-success" href="{{ route('InvoiceDetails', $f->id) }}">VER DETALLE</a></td>
        </tr>
        @empty
        <h1>No tienes compras realizadas</h1>
    @endforelse

    </tbody>
</table>


@endsection
