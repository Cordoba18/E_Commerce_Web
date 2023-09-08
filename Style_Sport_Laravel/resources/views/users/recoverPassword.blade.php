<!--Extendemos de la plantilla  -->
@extends('layaouts.app')

<!-- Titulo para la vista utilizando sesion de la plantilla -->
@section('title', 'recordar contraseña')
<!-- Sesion del CSS para la plantilla-->
@section('css')
<!-- importo el CSS especifico para esta vista por medio de la ruta de viteconfig -->
    @vite(['resources/css/recoverpassword.css'])
    @vite(['resources/css/form.css'])
@endsection
<!-- Agrego el contenido para la plantilla-->
@section('content')

<!-- Formulario para recuperar contraseña -->
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
<!-- Mensaje de error en caso de no existir el correo en la base de datos -->
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
