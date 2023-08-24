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
            <input type="password" name="password" placeholder="Contraseña">
            @error('password')
            <h6>{{ $message }}</h6>
            @enderror
            <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña">
            @error('password_confirmation')
            <h6>{{ $message }}</h6>
            @enderror
            @if (session('credentials'))
            <p>{{ session('credentials') }}</p>
        @endif
            <button type="submit">CAMBIAR CONTRASEÑA</button>
        </form>

    </main>

@endsection