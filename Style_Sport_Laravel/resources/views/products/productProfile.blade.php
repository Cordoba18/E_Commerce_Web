@extends('layaouts.main')
<div id="contenedor_estrellas">

</div>
@section('title', 'perfil producto')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.8/glider.min.css">
    @vite(['resources/css/paginaProducto.css'])
@endsection

@section('content')

    <main class="main">
        <div class="header">
        </div>
        <div class="profileProduct">
            <section class="columnone">
                <div class="img">
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                            @php
                                $imagePath = '';
                                $active = true;
                            @endphp

                            @foreach ($imgs as $img)
                                @php
                                    $imagePath = 'storage/imgs/' . $img->imagen;
                                    $imageInfo = @getimagesize(public_path($imagePath));
                                @endphp
                                @if ($imageInfo !== false)
                                    <div class="carousel-item @if ($active) active @endif">
                                        <img src="{{ asset($imagePath) }}" class="d-block w-100" alt="...">
                                    </div>
                                @else
                                    <div class="carousel-item @if ($active) active @endif">
                                        <img src="{{ asset('storage/imgs/images.png') }}">
                                    </div>
                                @endif
                                @php
                                    $active = false;
                                @endphp
                            @endforeach


                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </section>
            <section class="columntwo">
                <div class="description">
                    <p class="title">{{ $product->nombre }}</p>
                    <p class="description">{{ $product->descripcion }}</p>
                    <p class="category">{{ $category->categoria }}</p>
                    <p class="price">${{ $product->precio }} ${{ $discount }} {{ $product->descuento }}%</p>
                </div>
                <div class="details">
                    <div class="promedio">
                        @php
                        if ($product->calificacion) {
                            for ($i=0; $i < intval(round($product->calificacion)) ; $i++) {
                                print "<i class='fa-solid fa-star'></i>";
                            }
                            for ($i=0; $i < 5-intval(round($product->calificacion)) ; $i++) {
                                print "<i class='fa-regular fa-star'></i>";
                            }
                            print "<span>($product->calificacion)</span>";
                            print "<p>$product->n_p_calificaron calificaciones</p>";}else {
                                for ($i=0; $i < 5 ; $i++) {
                                print "<i class='fa-regular fa-star'></i>";
                            }
                            print "<span>(0)</span>";
                            print "<p>No hay calificaciones</p>";
                            }
                        @endphp

                    </div>
                    <button id="btn_calificar" class="btn btn-success btn-sm">CALIFICAR PRODUCTO</button>
                    <form action="{{ route('shoppingcart.store') }}" method="post">
                        @csrf
                        @auth
                            <input type="hidden" name="user" value="{{ Auth::user()->id }}">
                        @endauth
                        <input type="hidden" name="product" value="{{ $product->id }}">
                        <input type="hidden" name="price" value="{{ $discount }}">
                        <label>Color:</label>
                        <select name="color" id="">
                            <option disabled selected value="">Escoge una opcion</option>
                            @foreach ($color as $c)
                                <option value="{{ $c->id }}">{{ $c->color }}</option>
                            @endforeach
                        </select>
                        @error('color')
                            <h6>{{ $message }}</h6>
                        @enderror
                        <label>Talla:</label>
                        <select name="size" id="selectTalla">
                            <option disabled selected value="">Escoge una opción</option>
                            @foreach ($size as $s)
                                <option value="{{ $s->id }}" data-cantidad="{{ $s->cantidad }}">
                                    {{ $s->talla }}</option>
                            @endforeach
                        </select>
                        @error('size')
                            <h6>{{ $message }}</h6>
                        @enderror
                        <label>Cantidad:</label>
                        <div class="amount">
                            <button type="button" class="plus">+</button>
                            <input type="number" name="amount" value="0">
                            <button type="button" class="less">-</button>
                        </div>
                        <div class="btns">
                            <button type="submit" class="addCart">Añadir al carrito</button>
                        </div>
                    </form>
                    <form action="{{ route('wishlist.store', $product->id) }}" method="get">
                    <button class="wishList">Favoritos</button>
                </form>


                </div>
            </section>
        </div>
        <div class="carouselProduct">
            <article class="contenedor">
                <div class="carousel-productos">
                    <div class="carousel-contenedor">
                        <h3>Relaccionados</h3>
                        <button aria-label="Anterior" class="carousel-anterioro carousel-anterior">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>

                        <div class="carousel-listao">
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
    </main>



@endsection

@section('js')
@if (session('no-cart'))
<script>
Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'LA CANTIDAD ESTA FUERA DE RANGO'
})
</script>
@endif
@if (session('cart'))
<script>
    Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'PRODUCTO AGREGADO AL CARRITO',
                showConfirmButton: false,
                timer: 1500
              })
</script>
@endif

@if (session('list')){
    <script>
        Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'PRODUCTO AGREGADO ALA LISTA DE DESEOS',
                    showConfirmButton: false,
                    timer: 1500
                  })
    </script>
}
@endif
<script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.8/glider.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @vite(['resources/js/productProfile.js','resources/js/productCarousel.js'])
@endsection
