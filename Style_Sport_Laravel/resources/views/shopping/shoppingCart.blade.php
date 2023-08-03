@extends('layaouts.main')

@section('title', 'carrito')

@section('content')

<center><h1 style="font-size: 40px; padding: 40px">Carrito de compras</h1></center>
<p hidden id="user">{{ $id }}</p>
@php
    $total = 0;
@endphp
<table class="table">

    <thead>
        <th>NOMBRE</th>
        <th>TOTAL</th>
        <th>IMAGEN</th>
        <th>TALLA</th>
        <th>COLOR</th>
        <th>CANTIDAD</th>
        <th>ACCION</th>

    </thead>
    <tbody>
        @foreach($carrito as $c)
        <tr id="producto_carrito">
            <td>{{ $c->nombre }}</td>
            <td>{{ $c->total }}</td>
            <td>
                @php
                $total = $total + ($c->total * $c->cantidad_producto);
                $foundImage = false;
                $imagePath = '';
            @endphp

            @foreach ($Imagenes_productos as $img)
                @if ($img->id_producto == $c->id_producto)
                    @php
                        $imagePath = 'storage/imgs/' . $img->imagen;
                    @endphp
                    @if (file_exists(public_path($imagePath)))
                        <img  style="width: 300px; height: 180px;" src="{{ asset($imagePath) }}">
                        @php
                            $foundImage = true;
                        @endphp
                    @endif
                    @break
                @endif
            @endforeach

            @unless ($foundImage)
                <img style="width: 300px; height: 180px; " src="{{ asset('storage/imgs/images.png') }}">
            @endunless</td>
            <td>{{ $c->talla }}</td>
            <td>{{ $c->color }}</td>
            <td><form action="">
                @csrf
                <select id="seleccion_cantidad" name="">
                <option value="{{ $c->cantidad_producto }}"> {{ $c->cantidad_producto }}</option>
                @php
                    for ($i=1; $i < $c->cantidad_total+1 ; $i++) {
                        if ($i == $c->cantidad_producto) {
                            # code...
                        }else {
                            @endphp
                            <option value={{ $i }}> {{ $i }} </option>
                            @php
                        }
                    }
                @endphp
                </select></form></td>
                <td><button id="btn_accion" class="btn btn-danger">ELIMINAR</button>  <p hidden id="id_carrito">{{ $c->id }}</p> <p hidden id="total">{{ $c->total}}</p>
                    <p hidden id="cantidad">{{ $c->cantidad_producto}}</p></td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>TOTAL = </h3><h2 id="total_full">{{ $total }}</h2>
<button id="btn_comprar" class="btn btn-success"> COMPRAR </button>
<div hidden id="contenedor_btn_comprar">
    <a id="btn_ir_a_comprar" class="btn btn-primary" href="{{ route('shoppingcart.comprar') }}"> IR A COMPRAR</a>
</div>

@endsection

@section('js')

@vite(['resources/js/ShoppingCart.js'])
@if (session('mensaje'))
<script>
Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'NO SELECCIONASTE PRODUCTOS'
})
</script>
@endif
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
@endsection
