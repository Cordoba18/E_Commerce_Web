@extends('layaouts.main')

@section('title', 'home')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.8/glider.min.css">
    @vite(['resources/css/home.css'])
@endsection

@section('content')
    <main class="main">
        <section>
            @include('layaouts.partials.slider')
        </section>

        @auth
            <p>{{ Auth::user()->nombre }}</p>

            <form action="{{ Route('logout') }}" method="post">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth

        <section>
            <article class="contenedor">
                <div class="carousel-productos">
                    <div class="carousel-contenedor">

                        <button aria-label="Anterior" class="carousel-anteriorD carousel-anterior">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>

                        <div class="carousel-listaD">
                            @include('layaouts.partials.productCarousel')
                        </div>
                        
                        <button aria-label="Siguiente" class="carousel-siguienteD carousel-siguiente">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </article>
        </section>
    </main>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.8/glider.min.js"></script>
    @vite(['resources/js/Slider.js', 'resources/js/productCarousel.js'])
@endsection
