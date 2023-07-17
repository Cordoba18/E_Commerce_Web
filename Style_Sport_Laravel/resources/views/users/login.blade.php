@extends('layaouts.app')

@section('title', 'login')

@section('css')
    @vite(['resources/css/form.css'])
@endsection

@section('content')

    <main class="wrapper">
        <h1>Iniciar sesion</h1>
        <p>Bienvenido de nuevo!</p>
        <form action="{{ route('login.store') }}" method="post">
            @csrf
            <input type="email" name="email" placeholder="Email">
            @error('email')
                <h6>{{ $message }}</h6>
            @enderror
            <input type="password" name="password" placeholder="Password">
            @error('password')
                <h6>{{ $message }}</h6>
            @enderror
            @if (session('status'))
                {{ session('credentials') }}
            @endif
            <p class="recover">
                <a href="#">Olvidaste tu contraseña?</a>
            </p>
            <button type="submit">Log in</button>
        </form>
        <div class="not-member">
            <a href="/">Cancelar</a>
        </div>
        <div class="not-member">
            No tienes cuenta? <a href="{{ route('register') }}">Registrate ahora</a>
        </div>
    </main>

@endsection
