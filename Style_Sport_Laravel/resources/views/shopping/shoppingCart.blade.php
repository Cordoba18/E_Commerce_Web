@extends('layaouts.main')

@section('title', 'carrito')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.8/glider.min.css">
@vite(['resources/css/shoppingcart.css'])
@endsection
@section('content')
<div class="Content-ShoppinCart">
<div class="content_left">
<h1>Carrito de compras</h1>
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

            @foreach ($imgProduct as $img)
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
            <td id="tallas_id" hidden>{{ $c->tallas_id }}</td>
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
<div class="content-carousel">
    <div class="carouselProduct">
        <article class="contenedor">
            <div class="carousel-productos">
                <div class="carousel-contenedor">
                    <h3>Te podrian interesar</h3>
                    <button aria-label="Anterior" class="carousel-anterioro carousel-anterior">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>

                    <div class="carousel-listao" >
                        @foreach ($Products as $P)
                            @include('layaouts.partials.productCarousel')
                        @endforeach
                    </div>

                    <button aria-label="Siguiente" class="carousel-siguienteo carousel-siguiente">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </article>
    </div>
</div>
</div>

<div class="content_right">
<h3>TOTAL </h3> <div class="content-total"><p>$</p><p id="total_full">{{ $total }}</p>  <p class="cop">COP </p></div>
<button id="btn_comprar" > COMPRAR </button>
<div hidden id="contenedor_btn_comprar">
    <a id="btn_ir_a_comprar" href="{{ route('shoppingcart.comprar') }}"> IR A PAGAR</a>

</div>
<img src="{{ asset('storage/imgs/icon/banner_1.gif') }}">
</div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.8/glider.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
@vite(['resources/js/ShoppingCart.js', 'resources/js/productCarousel.js'] )
@if (session('mensaje'))
<script>
Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'NO SELECCIONASTE PRODUCTOS'
})
</script>
@endif
@endsection
