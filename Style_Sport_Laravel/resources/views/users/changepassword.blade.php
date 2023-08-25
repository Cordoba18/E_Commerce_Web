@extends('layaouts.app')

@section('title', 'cambio de contraseña')

@section('css')
@vite(['resources/css/form.css'])
@endsection

@section('content')

    <main class="wrapper">
        <h1>CAMBIAR CONTRASEÑA</h1>
        <form action="" method="post">
            @csrf
            <input hidden type="email" value="{{ $correo }}">
            <input type="password" name="password" placeholder="Contraseña">
            <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña">
            <button type="submit">CAMBIAR CONTRASEÑA</button>
        </form>

    </main>

@endsection
