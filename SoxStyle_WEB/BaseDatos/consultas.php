<?php
include_once('Conexion.php');
include_once('../modelo/Usuario.php');
session_start();

function getRol($correo){

    include("../conexion/conexion.php");
    $sql = "SELECT `roles` FROM `users` WHERE `correo`= '$correo'";

    $query= mysqli_query($conectar,$sql);
    $resul = mysqli_fetch_array($query);
    $rol = $resul['roles'];

    return $rol;

}

#FUNCION PARA INICIAR SESION
function logear($email,$pass){

    #IMPORTACIONES
    include_once("../Herramientas/encriptar.php");
    include("conexion.php");

    #CONSULTA A LA BASE DE DATOS
    $sql ="SELECT  `correo`, `contrasena` FROM `users` WHERE correo='$email';";
    $query = mysqli_query($conectar,$sql);
    $resul = mysqli_fetch_array($query);
    $BDpass = $resul['contrasena'];

    if($query){
        
        #VERIFICACION DE CONTRASEÑA
        //if(verificarPass($pass,$BDpass)){

            #VERIFICACION DEL ROL
           // $rol = getRol($email);
            //if($rol == 1){
              //  header("Location: ../controlador/agregar.php");#ARREGLAR LOCATION
            //}else if($rol == 2){
               // header("Location: ../vista/mostrarC.php");#ARREGLAR LOCATION
            //}
        //}
    //}else{
        echo"Correcto $BDpass $email";
        return true;
    }
}

function loguearUsuario (Usuario $usuario){

    $conectar = conectar();

    $correo=$usuario->getCorreo();
    $pass=$usuario->getPass();

    $sql = "SELECT * FROM `usuarios` WHERE `email` = '$correo'";
    $query = mysqli_query($conectar,$sql); 

    $numero = false;

    $no_of_rows = mysqli_num_rows($query);

    if($no_of_rows > 0){
            $list_user = mysqli_fetch_array($query);
            $bdpass = $list_user['pass'];
            if (password_verify($pass, $bdpass)) {
                $numero= true;
                $_SESSION['User']=$list_user['id'];
            }
    }else{
        $numero= false;
    }
    mysqli_close($conectar);
    return $numero;
}

function registrarUsuario(Usuario $usuario){

    $conectar = conectar();

    $nombre = $usuario->getNombre();
    $apellido = $usuario->getApellido();
    $fecha = $usuario->getFechaNacimiento();
    $correo=$usuario->getCorreo();
    $pass=$usuario->getPass();

    $numero = false;

    $sql = "SELECT * FROM `usuarios` WHERE `email` = '$correo'";

    $query = mysqli_query($conectar,$sql);

    $no_of_rows = mysqli_num_rows($query);

    if($no_of_rows > 0){
        $_SESSION['existing_mail']=true;
        $numero = false;
    }else{
        $hash= password_hash($pass, PASSWORD_BCRYPT, ['cost'=>10]);

        $sql = "INSERT INTO `usuarios`(`nombre`, `apellido`, `fecha_nacimiento`, `email`, `pass`, `rol`, `estado`) VALUES 
        ('$nombre','$apellido','$fecha','$correo','$hash','1','1')";
    
        $query = mysqli_query($conectar,$sql);

        if ($query) {
            $numero = true;
        } else {         
            $numero = false;
        }
    }

    mysqli_close($conectar); 
    return $numero;
}

function AgregarFavoritos($dato){
    $conectar = conectar();
    $numero = false;
    $id_user = $_SESSION['User'];
    $sql = "INSERT INTO `favoritos`(`id_user`, `id_productos`, `fecha`) VALUES ('$id_user','$dato','11/11/11')";
    $query = mysqli_query($conectar,$sql); 
    if ($query) {
        $numero = true;
    }
    mysqli_close($conectar); 
    return $numero;
}


function EliminarFavoritos($dato){
    $conectar = conectar();
    $numero = false;
    $id_user = $_SESSION['User'];
    $sql = "DELETE FROM `favoritos` WHERE id_user = '$id_user' AND id_productos='$dato'";
    $query = mysqli_query($conectar,$sql); 
    if ($query) {
        $numero = true;
    }
    mysqli_close($conectar); 
    return $numero;
}

function AgregarCarrito($dato){
    $conectar = conectar();
    $numero = false;
    $id_user = $_SESSION['User'];
    $sql1 = "SELECT * FROM carrito WHERE id_user = '$id_user' AND id_productos='$dato'";
    $query = mysqli_query($conectar,$sql1);
    $no_of_rows = mysqli_num_rows($query);
    if ($no_of_rows > 0) { 
        $numero = false;
    } else { 
        $sql = "INSERT INTO `carrito`(`id_user`, `id_productos`) VALUES ('$id_user','$dato')";
        $query2 = mysqli_query($conectar,$sql); 
        if ($query2) {
            $numero = true;
        }
    }
    mysqli_close($conectar); 
    return $numero;
}

