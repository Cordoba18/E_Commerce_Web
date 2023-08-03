@extends('layaouts.main')

@section('title', 'perfil usuario')

@section('css')
    @vite(['resources/css/customerprofile.css'])
@endsection

@section('content')

<main class="main">

<div class="profile">

<aside class="navegation-profile">
    <h2>Mi cuenta</h2>
<ul>
    <li>Informacion de usuario</li>
    <li>Historial de compras</li>
    <li>Cerrar sesion</li>
    <li>Eliminar cuenta</li>
</ul>
</aside>

<div class="panel">
    @yield('m-content')
</div>

</div>



</main>

@endsection
{{-- <p>nombre: {{ $user->nombre }}</p>
<p>correo: {{ $user->correo }}</p>
<p>telefono: {{ $user->telefono ? $user->telefono : '********' }}</p>

<p>identificacion: {{ $user->Identificacion ? $user->telefono : '************' }}</p> --}}