@extends('layaouts.main')

@section('title', 'perfil producto')

@section('css')
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
                                        <img src="{{ asset('storage/imgs/image_icon-icons.com_50366.png') }}">
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
                    <form action="{{ route('shoppingcart.store') }}" method="post">
                        @csrf
                        @auth
                        <input type="hidden" name="user" value"{{ Auth::user()->id }}">
                        @endauth
                        <input type="hidden" name="product" value="{{ $product->id }}">
                        <input type="hidden" name="price" value="{{ $discount }}">
                        <label>Color:</label>
                        <select name="color" id="">
                            <option disabled selected value="">Escoge una opcion</option>
                            @foreach ($color as $c)
                            <option value="{{ $c->color }}">{{ $c->color }}</option>
                            @endforeach
                        </select>
                        <label>Talla:</label>
                        <select name="size" id="selectTalla">
                            <option disabled selected value="">Escoge una opción</option>
                            @foreach ($size as $s)
                                <option value="{{ $s->talla }}" data-cantidad="{{ $s->cantidad }}">{{ $s->talla }}</option>
                            @endforeach
                        </select>
                        <label>Cantidad:</label>
                        <div class="amount">
                            <button type="button" class="plus">+</button>
                            <input type="number" name="amount" value="0" aria-valuemax="">
                            <button type="button" class="less">-</button>
                        </div>
                        <div class="btns">
                            <button type="submit" class="addCart">Añadir al carrito</button>
                        </div>
                    </form>
                    <button class="wishList">Favoritos</button>
                </div>
            </section>
        </div>
        <div class="carouselProduct">

        </div>
    </main>

@endsection

@section('js')
@vite(['resources/js/productProfile.js'])
@endsection