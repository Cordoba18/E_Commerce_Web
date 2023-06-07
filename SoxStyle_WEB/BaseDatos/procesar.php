<?php
include_once('consultas.php');

$datos = file_get_contents('php://input');
$datos_decodificados = json_decode($datos, true);

$id = $datos_decodificados['id'];
$accion = $datos_decodificados['accion'];

if ($accion == "agregar") {
    if($con = AgregarFavoritos($id)==true){
        echo "Se agrego el producto: ". $id ." a favoritos";
    }
}
if ($accion == "eliminar") {
    if($con = EliminarFavoritos($id)==true){
        echo "Se quito el producto: ". $id ." a favoritos";
    }
}
if ($accion == "agregar-carrito") {
    if($con = AgregarCarrito($id)==true){
        echo "Se agrego";
    }
}

?>
