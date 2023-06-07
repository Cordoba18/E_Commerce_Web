<?php 

    if(isset($_POST['comprar'])){
    
        $contrasena = $_POST['contrasena'];
}

?>
<?php $url = "../"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/Vcompra2.css">
    <title>Lista de productos</title>
</head>
<?php include_once('../Complementos/Header.php') ?>
<body>
<div class="container">
  <h1>Lista de productos</h1>

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

        <?php
            include("../controlador/pagina_de_compra_2_controller.php");
        ?>
    </form>
    </div>
</body>
<?php include_once('../Complementos/Footer.php') ?>
</html>