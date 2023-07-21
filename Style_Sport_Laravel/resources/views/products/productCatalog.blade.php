@extends('layaouts.main')

@section('title', 'producto catalogo')

@section('css')
    @vite(['resources/css/productCatalog.css'])
@endsection

@section('content')

    <main class="main">
        <div class="columnone">
            @include('layaouts.partials.aside')
        </div>
        <div class="columntwo">

            @if (session('search'))
                <h2>Resultado de: {{ session('search') }}</h2>
            @elseif (session('category'))
                <h2>Resultado de: {{ session('category')->categoria }}</h2>
            @else
                <h2>Resultados:</h2>
            @endif

            <div class="results">
                @foreach ($productos as $p)
                    <div class="card-product">
                        <img src="">
                        <div class="card-product-body">
                            <div>
                                <h3>{{ $p->nombre }}</h3>
                                <p>{{ $p->descripcion }}</p>
                                <p>Envio gratis</p>
                            </div>
                            <div>
                                <p>${{ $p->precio }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

@endsection
