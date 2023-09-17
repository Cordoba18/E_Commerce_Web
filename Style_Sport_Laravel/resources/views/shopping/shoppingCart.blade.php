<!-- Extendemos de la plantilla -->
@extends('layaouts.main')

<!-- div para la animacion de carga -->
<div id="content-carga"></div>
<!-- seccion para el titulo de la pagina -->
@section('title', 'carrito')

<!-- seccion para el CSS -->
@section('css')
<!-- Por medio del cdn accedemos al css de glider para el carousel -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.8/glider.min.css">
<!-- importo el CSS especifico para esta vista por medio de la ruta de viteconfig -->
@vite(['resources/css/shoppingcart.css'])
@endsection
<!-- Agrego el contenido para la plantilla-->
@section('content')
<div class="Content-ShoppinCart">
  <div class="content_left">
<h1 id="tittle">CARRITO DE COMPRAS</h1>
<!-- Inicializo variable para el total de los productos-->
@php
    $total = 0;
@endphp
<!--imprimo la informacion del carrito-->
    @forelse($carrito as $c)
    <div id="producto_carrito" class="content_target_cart">
        <div class="img_cart">
        <a href="{{route('productprofile', $c->id_producto)}}">
            <!-- Calculo de total y manejo de las imagenes-->
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
                <!-- si no hay productos en el carrito solo mostramos un mensaje que lo confirma-->
    <h1>No hay resultados productos en tu carrito de compras</h1>
@endforelse
<p hidden id="user">{{ $id }}</p>

</div>
       <!-- contenedor del total donde colocamos la variable total calculada -->
<div class="content_right">
    <div id="content_form_pagar">
<h3>TOTAL </h3> <div class="content-total"><p>$</p><p id="total_full">{{  number_format(intval(round($total))) }}</p>  <p class="cop">COP </p></div>
<button id="btn_comprar" > COMPRAR </button>
<div hidden id="contenedor_btn_comprar">
    <button id="btn_ir_a_comprar" > IR A PAGAR</button>

</div>
</div>
<img src="{{ asset('storage/imgs/icon/banner_1.gif') }}">
</div>
   <!-- contenedor del carousel de los productos de interes  -->
<div class="content-carousel">
    <div class="carouselProduct">
        <article class="contenedor">
            <div class="carousel-productos">
                <div class="carousel-contenedor">
                    <h3>Te podrìan interesar</h3>
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
   <!-- sesion del JAVASCRIPT para la plantilla  -->
@section('js')
   <!-- usamos por medio de cdn glider y Jquery -->
<script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.8/glider.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<!-- importo el javascript especifico para esta vista por medio de la ruta de viteconfig -->
@vite(['resources/js/ShoppingCart.js', 'resources/js/productCarousel.js'] )
<script>
    let btn_ir_a_comprar = document.querySelector("#btn_ir_a_comprar");
let carga = document.querySelector("#content-carga");

//Boton que activa la animacion de carga y redirecciona al formulario de compra
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
   <!-- Mensaje de error en caso de no haber seleccionado productos  -->
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
