<!-- Extendemos de la plantilla -->
@extends('layaouts.app')
<!-- Seccion del CSS para la plantilla-->
@section('css')
<!-- importo el CSS especifico para esta vista por medio de la ruta de viteconfig -->
    @vite(['resources/css/ValidateEmail.css'])
    @vite(['resources/css/form.css'])
@endsection
<!-- Titulo para la vista utilizando sesion de la plantilla -->
@section('title', 'Cambio de contraseña')
<!-- Agrego el contenido para la plantilla-->
@section('content')
<!-- Correo del usuario -->
    <p hidden id="email">{{ $email }}</p>
    @csrf
    <div class="contenedor">
        <br>
        <br>
        <br>
       <!--Formulario ingreso de codigo-->
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

 <!-- seccion del JAVASCRIPT para la plantilla  -->
@section('js')
   <!-- usamos por medio de cdn Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- importo el javascript especifico para esta vista por medio de la ruta de viteconfig -->
        @vite(['resources/js/VerificationEmailpassword.js'])
@endsection
