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
                    <a href="{{route('productprofile', $p->id)}}">
                        <div class="card-product">
                            @php
                                $foundImage = false;
                                $imagePath = '';
                            @endphp

                            @foreach ($imgProduct as $img)
                                @if ($img->id_producto == $p->id)
                                    @php
                                        $imagePath = 'storage/imgs/.' . $img->imagen;
                                    @endphp
                                    @if (file_exists(public_path($imagePath)))
                                        <img src="{{ asset($imagePath) }}">
                                        @php
                                            $foundImage = true;
                                        @endphp
                                    @endif
                                @break
                            @endif
                        @endforeach

                        @unless ($foundImage)
                            <img src="{{ asset('storage/imgs/image_icon-icons.com_50366.png') }}">
                        @endunless
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
                </a>
            @endforeach
        </div>
        {{ $productos->appends(['search' => $search])->links() }}
    </div>
</main>

@endsection
