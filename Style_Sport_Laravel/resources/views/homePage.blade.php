@extends('layaouts.main')

@section('title', 'home')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.8/glider.min.css">
    @vite(['resources/css/home.css'])
@endsection

@section('content')
    <main class="main">
        <section>
            @include('layaouts.partials.slider')
        </section>
        <section>
            <article class="contenedor">
                <div class="carousel-productos">
                    <div class="carousel-contenedor">
                        <h3>Destacados</h3>
                        <button aria-label="Anterior" class="carousel-anteriorD carousel-anterior">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>

                        <div class="carousel-listaD">
                            @foreach ($Product_desc as $P)
                                @include('layaouts.partials.productCarousel')
                            @endforeach
                        </div>

                        <button aria-label="Siguiente" class="carousel-siguienteD carousel-siguiente">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </article>
            <article class="contenedor">
                <div class="carousel-productos">
                    <div class="carousel-contenedor">
                        <h3>Novedades</h3>
                        <button aria-label="Anterior" class="carousel-anteriorf carousel-anterior">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>

                        <div class="carousel-listaf">
                            @foreach ($Product_novedades as $P)
                                @include('layaouts.partials.productCarousel')
                            @endforeach
                        </div>

                        <button aria-label="Siguiente" class="carousel-siguientef carousel-siguiente">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </article>
            <article class="contenedor">
                <div class="carousel-productos">
                    <div class="carousel-contenedor">
                        <h3>Descuentos</h3>
                        <button aria-label="Anterior" class="carousel-anterioro carousel-anterior">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>

                        <div class="carousel-listao">
                            @foreach ($Product as $P)
                                @include('layaouts.partials.productCarousel')
                            @endforeach
                        </div>

                        <button aria-label="Siguiente" class="carousel-siguienteo carousel-siguiente">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </article>
        </section>
    </main>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.8/glider.min.js"></script>
    @vite(['resources/js/Slider.js', 'resources/js/productCarousel.js'])
@endsection
