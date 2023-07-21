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

            <h2>Resultados:</h2>

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
{{$productos->appends(['search'=> $search])->links()}}
        </div>
    </main>

@endsection
