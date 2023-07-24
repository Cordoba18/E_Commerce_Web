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
                    <img src="https://img.freepik.com/vector-premium/diseno-camisetas-futbol-sublimacion-diseno-camisetas-deportivas_29096-3212.jpg" alt="">
                </div>
            </section>
            <section class="columntwo">
                <div class="description">
                    <p>{{$product->nombre}}</p>
                    <p>{{$product->descripcion}}</p>
                    <p>{{$category->categoria}}</p>
                    <p>${{$product->precio}}  {{$product->descuento}}%</p>
                </div>
                <div class="details">
                    <form action="#" method="post">
                        @csrf
                        <label>Color:</label>
                        <select name="" id="">
                            <option disabled selected value="">Escoge una opcion</option>
                            <option value="color">color</option>
                        </select>
                        <label>Talla:</label>
                        <select name="" id="">
                            <option disabled selected value="">Escoge una opcion</option>
                            <option value="talla">talla</option>
                        </select>
                        <label>Cantidad:</label>
                        <div class="amount">
                            <button class="plus">+</button>
                            <input type="number" name="amount" value="0">
                            <button class="less">-</button>
                        </div>
                        <div class="btns">
                            <button class="clear">limpiar</button>
                            <button type="submit" class="addCart">Añadir al carrito</button>
                            <button class="wishList">Favoritos</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        <div class="carouselProduct">

        </div>
    </main>

@endsection
