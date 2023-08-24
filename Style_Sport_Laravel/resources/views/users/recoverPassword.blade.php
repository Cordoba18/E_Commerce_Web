@extends('layaouts.app')

@section('title', 'recordar contraseña')
@section('css')
    @vite(['resources/css/recoverpassword.css'])
@endsection
@section('content')

<div class="contenedor">
  <h1>Recuperar contraseña</h1>
  <h2>Digita tu correo electronico para poder continuar</h2>

<form action="{{ route('recoverpassword.validation_email')}}" method="POST">
    @csrf
    <div class="form-group">
    <label for="inputEmail3"><strong>Correo Electronico</strong></label>
    <br>
    <input type="email" name="email" id="inputEmail3" class="form-control">
    <button type="submit" class="boton">Enviar codigo</button>
    </div>
</form>
</div>

@endsection