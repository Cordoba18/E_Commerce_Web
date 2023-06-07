<?php
include_once('../BaseDatos/Consultas.php');
include_once('../modelo/Usuario.php');
include_once('../Herramientas/Validaciones.php');
session_start();

if (isset($_POST['registrarse'])) {
    
        $usuario = new Usuario();

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha = $_POST['fecha'];
        $correo = $_POST['email'];
        $pass = $_POST['pass'];

        if ($v = comprobarVacioRgister($nombre, $apellido, $fecha, $correo, $pass)) {
        if ($v = comprobarFechaNacimiento($fecha)) {
            if ($v = longitudPass($pass) && $v = caracteresPass($pass)) {
    
                $usuario->setNombre($nombre);
                $usuario->setApellido($apellido);
                $usuario->setFechaNacimiento($fecha);
                $usuario->setCorreo($correo);
                $usuario->setPass($pass);
    
                if ($con = registrarUsuario($usuario) == true) {
                    header('location: ../vista/Login.php');
                } else {
                    header('location: ../vista/Register.php');
                }
            } else {
                $_SESSION['Incorrect_pass'] = true;
                header('location: ../vista/Register.php');
            }
        } else {
            $_SESSION['invalid_date'] = true;
            header('location: ../vista/Register.php');
        }    
    } else {
        $_SESSION['Empy'] = true;
        header('location: ../vista/Register.php');
    }    
}
if (isset($_POST['loguearse'])) {

    $usuario = new Usuario();

    $correo = $_POST['email'];
    $pass = $_POST['pass'];

    //Validar datos

    $usuario->setCorreo($correo);
    $usuario->setPass($pass);

    if ($con = loguearUsuario($usuario) == true) {
        header('location: ../Index.php');
    } else {
        $_SESSION['incorrect_login'] = true;
        header('location: ../vista/Login.php');
    }
}
