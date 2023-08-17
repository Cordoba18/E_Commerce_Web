@extends('customers.customerProfile')

@section('m-content')


<h1>DETALLE DE FACTURA</h1>
<table class="">

    <thead>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>TOTAL</th>
        <th>CANTIDAD</th>
        <th>TALLA</th>
        <th>COLOR</th>
    </thead>
    <tbody>
        @forelse ($detalles as $d)
        <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->nombre }}</td>
            <td>${{ number_format(intval(round($d->total))) }}</td>
            <td>{{ $d->cantidad }}</td>
            <td>{{ $d->talla }}</td>
            <td>{{ $d->color }}</td>
        </tr>
        @empty
        <h1>DETALLES DE FACTURA NO ENCONTRADOS</h1>
    @endforelse

    </tbody>
</table>


@endsection
