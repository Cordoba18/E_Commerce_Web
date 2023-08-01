@extends('layaouts.main')

@section('title', 'perfil usuario')

@section('css')
    @vite(['resources/css/customerprofile.css'])
@endsection

@section('content')

<main class="main">
    <section class="top">
        <div class="columnone">
            <img src="" alt="">
        </div>
        <div class="columntwo">
            <div class="basicinfo">
                <p>nombre: {{ $user->nombre }}</p>
                <p>correo: {{ $user->correo }}</p>
                <p>telefono: {{ $user->telefono ? $user->telefono : '********' }}</p>

                <p>identificacion: {{ $user->Identificacion ? $user->telefono : '************' }}</p>
            </div>
        </div>
    </section>
    <nav class="navegation">
        <ul>
            <li>Historial de compras</li>
            <li>Informacion de usuario</li>
        </ul>
    </nav>
    <section class="botton">
        <article class="shopphistory">
            
        </article>
        <article class="infouser">
            <div class="showinfo">

            </div>
            <div class="editinfo">

            </div>
        </article>
    </section>
</main>

@endsection
