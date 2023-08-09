@extends('customers.customerProfile')

@section('m-content')


<h1>DETALLE DE FACTURA</h1>
<table class="table">

    <thead>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>TOTAL</th>
        <th>CANTIDAD</th>
        <th>TALLA</th>
        <th>COLOR</th>
    </thead>
    <tbody>
        @foreach ($detalles as $d)
        <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->nombre }}</td>
            <td>${{ $d->total }}</td>
            <td>{{ $d->cantidad }}</td>
            <td>{{ $d->talla }}</td>
            <td>{{ $d->color }}</td>
        </tr>
        @endforeach

    </tbody>
</table>


@endsection
