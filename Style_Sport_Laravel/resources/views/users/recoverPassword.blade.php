@extends('layaouts.app')

@section('title', 'recordar contraseña')
@section('css')
    @vite(['resources/css/recoverpassword.css'])
    @vite(['resources/css/form.css'])
@endsection
@section('content')

    <div class="contenedor">
        <h1>Recuperar contraseña</h1>
        <h2>Digita tu correo electronico para poder continuar</h2>

        <form action="{{ route('recoverpassword.validation_email') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="inputEmail3"><strong>Correo Electronico</strong></label>
                <br>
                <input style="text-align: center" type="email" name="email" id="inputEmail3" class="form-control">
                <button type="submit" class="boton">Enviar codigo</button>
                <div class="not-member">
                    <a href="{{route('login')}}">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    @if (session('recover_false'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...No eres parte de nosotros',
                text: 'No existe ningun usuario con ese correo'
            })
        </script>
    @endif
@endsection
