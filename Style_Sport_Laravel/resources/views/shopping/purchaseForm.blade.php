@extends('layaouts.app')

@section('title', 'formulario compras')

@section('css')
@vite(['resources/css/app.scss'])
@endsection
@section('content')

<h1>Formulario de compras</h1>

<div class="container">
    <form action="" method="post">
    <label for="nombre" class="txt">Nombre</label>
    <input type="text" name="nombre" class="campos">
    <br>
    <br>
    <label for="Contacto" class="txt">Contacto</label>
    <input type="text" name="contacto" class="campos">
    <br>
    <br>
    <label for="Correo" class="txt">Correo</label>
    <input type="text" name="correo" class="campos">
    <br>
    <br>
    <label for="Direccion" class="txt">Direccion</label>
    <input type="text" name="direccion" class="campos">
</div>

<div class="C2">
    <br>
    <br>
    <h2>Metodos de pago </h2>

    <div class="card">
       <div class="card-title">Metodo #1</div>
         <div class="card-content">
          <p class="tit">Entidad Bancaria<span class="wis"></span>**********</p>
          <p class="tit">Numero de Tarjeta<span class="wis"></span>**********</p>
      </div>
    </div>
    <input type="checkbox" class="ch">
    <br>
    <br>
    <div class="form-group">
    <label for="Cuotas a pagar">Cuotas a pagar:</label>
    <input type="text" name="cuotas">
    </div>
    <br><br>

    <div class="card-container">
     <div class="card-custom">
       <div class="card-title">Agregar Nuevo Método de Pago</div>
         <div class="card-content">
    <div class="card-content-text">
    </div>
    </div>
    </div>
     <div class="card-custom" style="flex: 0.1;">
    </div>
     </div>
     <br><br>

    <button type="submit" name="continuar" class="btn">Continuar</button>
</div>
</form>


@endsection

