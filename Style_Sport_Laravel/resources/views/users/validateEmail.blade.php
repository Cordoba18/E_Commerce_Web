@extends('layaouts.app')
@section('css')
@vite(['resources/css/ValidateEmail.css'])
@endsection
@section('title', 'registro')

<!--

-->

@section('content')

<p hidden id="datos">{{ $datos }}</p>
<div class="contenedor">
    <br>
    <br>
    <br>

  <div class="form-group">
    <h1 style="font-size: 15px">Estas a punto de crear tu cuenta por favor ingrese el codigo que hemos enviado a su cuenta <b><p id="correo"></p></b></h1>
    @csrf
    <strong>
      <input type="number" id="codigo" maxlength="4">
      </strong>
      <br>
      <br>

      <button  id="btn_siguiente" class="boton">TERMINAR</button>

@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
@vite(['resources/js/VerificationEmail.js'])
@endsection
