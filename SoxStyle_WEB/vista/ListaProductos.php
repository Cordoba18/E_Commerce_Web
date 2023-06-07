<?php include_once('../BaseDatos/Conexion.php');  
$url = "../";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include('../Librerias/Boostrap.php');
    include('../Librerias/FontawesoneLink.php');
    ?>
    <link rel="stylesheet" href="../Css/Header.css">
    <link rel="stylesheet" href="../Css/Footer.css">
    <link rel="stylesheet" href="../Css/ListaProductos.css">

    <title>Resultado</title>
</head>
<body>
    <header class="header">
    <?php include('../Complementos/Header.php'); ?>
    </header>
    <section class="section">
    <?php include('../Complementos/ResultadosBusqueda.php'); ?>
    </section>
    <footer class="footer">
    <?php 
     include_once('../Complementos/footer.php'); ?>
    </footer>
</body>
</html>