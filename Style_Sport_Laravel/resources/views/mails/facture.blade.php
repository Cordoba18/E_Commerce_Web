<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FACTURA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<style>
    td{
        text-align: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 15px;
        }
</style>
<body>
    @php
    $total = 0;
@endphp
    <h5 style="text-align: center; color: red; font-size: 40px; font-weight: bold">!GRACIAS POR TU COMPRA!</h5><br>
    <p  style="text-align: center;">Aqui Tienes el detalle de tu factura</p><br>
    <h1>DETALLE DE FACTURA</h1>
    <br>
    <table class="table table-danger" style="border: 1px solid black; width: 100%; text-align: center">

        <thead>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>TOTAL</th>
            <th>CANTIDAD</th>
            <th>TALLA</th>
            <th>COLOR</th>
        </thead>
        <tbody>
            @foreach ($compras as $d)
            <tr>

                <td>{{ $d->id }}</td>
                <td>{{ $d->nombre }}</td>
                @php
                $total = $total + ($d->total * $d->cantidad);
            @endphp
                <td>${{  number_format(intval(round($d->total))) }}</td>
                <td>{{ $d->cantidad }}</td>
                <td>{{ $d->talla }}</td>
                <td>{{ $d->color }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <br>
    <div style="display: flex;font-size: 20px; color: red; text-align: center">
    <h4 style= "font-weight: bold">TOTAL ${{ number_format(intval(round($total))) }}</h4>

</div>
    <h3 style="font-size: 30px; text-align: center">MANTENTE ATENTO A NUEVAS OFERTAS!</h3>

</body>
</html>
