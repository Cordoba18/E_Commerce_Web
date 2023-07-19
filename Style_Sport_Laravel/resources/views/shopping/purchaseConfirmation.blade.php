@extends('layaouts.app')

@section('title', 'confirmacion compra')

@section('css')
@vite(['resources/css/purchaseconfirmation.css'])
@endsection

@section('content')

<div class="container">
<h1>confirmacion de compra</h1><br><br>
    <h2>Lista de productos</h2><br>

    <div class="table-container">
      <table>
        <tr>
          <td class="t1">Camisa verde</td>
          <td class="t2">$*******</td>
        </tr>
        <tr>
          <td class="t1">Camisa roja</td>
          <td class="t2">$*******</td>
        </tr>
        <tr>
          <td class="t1">Camisa negra</td>
          <td class="t2">$*******</td>
        </tr>
        <tr>
          <td class="tot">Total</td>
          <td class="t2">$*******</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="linea-horizontal"></div>


      </div>
      <br>
      <br>
      <div class="conta2">
      <form action="" method="post">
          <label for="Texto contrasena">Por favor ingrese la contraseña para realizar la compra</label>
          <br>
          <br>
          <label class="txt2" for="contrasena">Contraseña</label>
          <input class="campos2" type="text" name="contrasena">
          <br>
          <br>
          <button type="submit" name="comprar" >Comprar</button>
      </form>
      </div>

@endsection

