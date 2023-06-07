<!--Validacion para ingresar a la lista de deseo solo si te has logeado -->
<?php
//session_start();

  //if (empty($_SESSION['email']['pass'])) {
    
    //header('Location: login.php');
    //exit;
    //}
?>
<!-- este codigo es de la base de datos de prueba --> /
<?php
    $connect = mysqli_connect("localhost","root",""     ,"lista_deseos");
?> 
<!--  -->
<!DOCTYPE html>
<html lang="es">
    <head> 
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0.">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Lista de deseos</title>

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
     <link rel="stylesheet" href="./style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    </head>
     <body>  
             <div class="contenedor">
                <img src="../V-Lista_deseos/SoxStyle.jpg" alt="" class="image">
            </div>
               <div class="container">
                    <h3 class="text-left" id="carrito">Carrito:()</h3>
                    <h3 class="text-left">Favoritos:()</h3>
                </div>

            <div class="content-select">
	            <select class="select">
		            <option>En ofertas </option>
		            <option>Añadidos recientemente</option>
		            <option>Orden alfabetico</option>
                    <option>Precio</option>
	            </select>
	            
            </div>
            <br>
            <br>    
            <div class="card-header text-center">
                   <p>PRODCUTOS
                   </p>
            </div>
            <br>
        <table>
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <!-- esta es la base de datos de prueba -->
                <?php
                $query = "SELECT * FROM list_deseo";
                $result = mysqli_query($connect, $query);

                while ($row = mysqli_fetch_array($result)) {
                    $imagen = $row['imagen'];
                    $nombre_producto = $row['nombre_producto'];
                    $precio = $row['precio'];

                    echo "<tr>";
                    echo "<td><img src='img/$imagen' alt='Imagen del producto'></td>";
                    echo "<td>$nombre_producto</td>";
                    echo "<td>$$precio</td>";
                    echo "<td class='accion-column'><button class='eliminar-button' data-producto-id='$nombre_producto'>Eliminar</button><a href='carrito.php' class='carrito-icon'><i class='fas fa-shopping-cart'></i></a></td>";
                    echo "</tr>";
                }
                ?>
                <!--  -->
            </tbody>
        </table>
        
    </body>
    <br>
    <div class="card-header text-center">
            </div>
</html>