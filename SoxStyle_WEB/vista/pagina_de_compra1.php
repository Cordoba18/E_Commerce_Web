<?php 

    if(isset($_POST['continuar'])){
        $nombre = $_POST['nombre'];
        $contacto = $_POST['contacto'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];
        $cuotas = $_POST['cuotas'];
}

    // if(!isset($_SESSION['correo']) && $_SESSION['contrasena']){
    //header("location: login.php ");
// }


?>
<?php $url = "../"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../V-Compra01/CSS/Vcompra.css">
    <script src="https://kit.fontawesome.com/79a9f594c1.js" crossorigin="anonymous"></script>
    <title>Pagina de compra</title>
</head>
<?php include_once('../Complementos/Header.php') ?>
<body>
<div class="container">
        <h2>Página de compras </h2>
        <form action="" method="post">
        <label for="nombre" class="txt">Nombre</label>
        <input type="text" name="nombre" class="campos" value="<?php if(isset($nombre)) echo $nombre?>">
        <br>
        <br>
        <label for="Contacto" class="txt">Contacto</label>
        <input type="text" name="contacto" class="campos" value="<?php if(isset($contacto)) echo $contacto ?>" >
        <br>
        <br>
        <label for="Correo" class="txt">Correo</label>
        <input type="text" name="correo" class="campos" value="<?php if(isset($correo)) echo $correo ?>">
        <br>
        <br>
        <label for="Direccion" class="txt">Direccion</label> 
        <input type="text" name="direccion" class="campos" value="<?php if(isset($direccion)) echo $direccion ?>">
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
              <p class="tit">Codigo de Tarjeta<span class="wis"></span>**********</p>
          </div>
        </div>
        <input type="checkbox" class="ch">
        <br>
        <br>
        <div class="form-group">
        <label for="Cuotas a pagar">Cuotas a pagar:</label>
        <input type="text" name="cuotas" value="<?php if(isset($cuotas)) echo $cuotas ?>">
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
        <a href="../METODO DE PAGO/Metodo-de-pago.php" class="add-button">+</a>
        </div>
         </div>
         <br><br>

        <button type="submit" name="continuar" class="btn">Continuar</button>
</div>
        <?php

        include("../controlador/pagina_de_compra_controller.php");

        ?>
    </form>
</body>
<?php include_once('../Complementos/Footer.php') ?>
</html>