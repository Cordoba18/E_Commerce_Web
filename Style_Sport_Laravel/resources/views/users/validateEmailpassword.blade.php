@extends('layaouts.app')
@section('css')
    @vite(['resources/css/ValidateEmail.css'])
    @vite(['resources/css/form.css'])
@endsection
@section('title', 'Cambio de contraseña')
@section('content')

    <p hidden id="email">{{ $email }}</p>
    @csrf
    <div class="contenedor">
        <br>
        <br>
        <br>

        <div class="form-group">
            <h1 style="font-size: 15px">{{ $mensaje }}<b>
                    <p id="correo"></p>
                </b></h1>
            <strong>
                <form action="">
                <input style="text-align: center" type="text" id="codigo" maxlength="4">
            </strong>
            <br>
            <br>

            <button id="btn_siguiente" class="boton">TERMINAR</button>
        </form>
            <div class="not-member">
                <a href="{{route('login')}}">Cancelar</a>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @vite(['resources/js/VerificationEmailpassword.js'])
@endsection
