@extends('layaouts.app')

@section('title', 'registro')

@section('css')
@vite(['resources/css/form.css'])
@endsection

@section('content')

    <main class="wrapper">
        <h1>Registrarse</h1>
        <p>Bienvenido!</p>
        <form action="{{ route('register.store') }}" method="post">
            @csrf
            <input type="text" name="name" placeholder="Nombre">
            @error('name')
            <h6>{{ $message }}</h6>
            @enderror
            <input type="text" name="lastname" placeholder="Apellido">
            @error('lastname')
            <h6>{{ $message }}</h6>
            @enderror
            <input type="date"name="date" placeholder="Fecha de nacimiento">
            @error('date')
            <h6>{{ $message }}</h6>
            @enderror
            <input type="email" name="correo" placeholder="Correo">
            @error('correo')
            <h6>{{ $message }}</h6>
            @enderror
            <input type="password" name="password" placeholder="Contraseña">
            @error('password')
            <h6>{{ $message }}</h6>
            @enderror
            <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña">
            @error('password_confirmation')
            <h6>{{ $message }}</h6>
            @enderror
            <button type="submit">Register</button>
        </form>

        <div class="not-member">
            ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesion ahora</a>
        </div>

    </main>

@endsection