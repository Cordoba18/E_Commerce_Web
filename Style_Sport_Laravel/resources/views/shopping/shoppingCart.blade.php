@extends('layaouts.main')
<div id="content-carga"></div>
@section('title', 'carrito')


@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.8/glider.min.css">
@vite(['resources/css/shoppingcart.css'])
@endsection
@section('content')
<div class="Content-ShoppinCart">
  <div class="content_left">
<h1 id="tittle">CARRITO DE COMPRAS</h1>
@php
    $total = 0;
@endphp

    @forelse($carrito as $c)
    <div id="producto_carrito" class="content_target_cart">
        <div class="img_cart">
        <a href="{{route('productprofile', $c->id_producto)}}">
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
                    <img   src="{{ asset($imagePath) }}">
                    @php
                        $foundImage = true;
                    @endphp
                @endif
                @break
            @endif
        @endforeach

        @unless ($foundImage)
            <img class="no-found" src="{{ asset('storage/imgs/images.png') }}">
        @endunless </a>
        </div>
        <div class="content_producto_right">
        <h1>{{ $c->nombre }}</h1>
        <span>PRECIO</span>
        <p>${{ number_format(intval(round($c->total))) }} <p hidden id="total">{{ $c->total}}</p><p hidden id="cantidad">{{ $c->cantidad_producto}}</p></p></td>
            <div class="dates_conent">
                <span>TALLA</span>
        <p>{{ $c->talla }}</p>
        <span>COLOR</span>
        <p>{{ $c->color }}</p>
        <span>CANTIDAD</span>
        <p id="tallas_id" hidden>{{ $c->tallas_id }}</p>
        <form action="">
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
            </select></form>
                </div>
            <button id="btn_accion" class="btn btn-danger">ELIMINAR</button>  <p hidden id="id_carrito">{{ $c->id }}</p>
        </div></div>
    @empty
    <h1>No hay resultados productos en tu carrito de compras</h1>
@endforelse
<p hidden id="user">{{ $id }}</p>

{{-- <table class="">

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
        @forelse($carrito as $c)
        <tr id="producto_carrito">
            <td>{{ $c->nombre }}</td>
            <td>$  {{ number_format(intval(round($c->total))) }} <p hidden id="total">{{ $c->total}}</p><p hidden id="cantidad">{{ $c->cantidad_producto}}</p></td>
            <td><a href="{{route('productprofile', $c->id_producto)}}">
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
                        <img   src="{{ asset($imagePath) }}">
                        @php
                            $foundImage = true;
                        @endphp
                    @endif
                    @break
                @endif
            @endforeach

            @unless ($foundImage)
                <img  src="{{ asset('storage/imgs/images.png') }}">
            @endunless </a></td>
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
                <td><button id="btn_accion" class="btn btn-danger">ELIMINAR</button>  <p hidden id="id_carrito">{{ $c->id }}</p></td>
        </tr>
        @empty
        <h1>No hay resultados productos en tu carrito de compras</h1>
    @endforelse
    </tbody>
</table> --}}

</div>

<div class="content_right">
    <div id="content_form_pagar">
<h3>TOTAL </h3> <div class="content-total"><p>$</p><p id="total_full">{{ $total }}</p>  <p class="cop">COP </p></div>
<button id="btn_comprar" > COMPRAR </button>
<div hidden id="contenedor_btn_comprar">
    <button id="btn_ir_a_comprar" > IR A PAGAR</button>

</div>
</div>
<img src="{{ asset('storage/imgs/icon/banner_1.gif') }}">
</div>

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
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.8/glider.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
@vite(['resources/js/ShoppingCart.js', 'resources/js/productCarousel.js'] )
<script>
    let btn_ir_a_comprar = document.querySelector("#btn_ir_a_comprar");
let carga = document.querySelector("#content-carga");


btn_ir_a_comprar.addEventListener("click", () => {
    carga.innerHTML = "<div class='content-fondo-cargando'>"+
    "<div class='content-cargando'>"+
        "<img src='{{ asset('storage/imgs/icon/Cargando.gif') }}'>"+
    "</div>"+
    "</div>";

    setTimeout(() => {
        window.location.href = "shoppingcart/comprar";
    }, 5000);
})
</script>
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
