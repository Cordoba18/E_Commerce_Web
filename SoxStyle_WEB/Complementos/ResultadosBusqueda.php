<?php
$conectar = conectar();
if (isset($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];

    $sql = mysqli_query($conectar,"SELECT productos.* FROM productos
    INNER JOIN productos_filtros ON productos.id = productos_filtros.id_producto
    INNER JOIN filtros_busqueda ON filtros_busqueda.id = productos_filtros.id_filtro
    WHERE filtros_busqueda.nombre LIKE '%$busqueda%' or productos.nombre LIKE '%$busqueda%'");
    
    while ($producto = mysqli_fetch_array($sql)) {
        echo $producto['nombre']. '<br>';
    }
}