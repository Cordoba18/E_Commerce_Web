   <!-- Extendemos de la plantilla  -->
@extends('layaouts.app')

<!-- Titulo para la vista utilizando sesion de la plantilla -->
@section('title', 'registro')
<!-- Sesion del CSS para la plantilla-->
@section('css')
<!-- importo el CSS especifico para esta vista por medio de la ruta de viteconfig -->
@vite(['resources/css/form.css'])
@endsection
<!-- Agrego el contenido para la plantilla-->
@section('content')
<!--Formulario de registro -->
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
            <input type="date" name="date" placeholder="Fecha de nacimiento" max="2005-10-08">
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
            @if (session('credentials'))
            <p>{{ session('credentials') }}</p>
        @endif
            <button type="submit">Register</button>
        </form>

        <div class="not-member">
            ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesion ahora</a>
        </div>

    </main>

@endsection
