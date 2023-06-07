<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/fForm.css">
    <title>Register</title>
</head>

<body>
    <div class="wrapper">
        <h1>Registrarse</h1>
        <p>Bienvenido!</p>
        <form action="../controlador/CtrlRegistroUsuario.php" method="post">
            <input type="hidden" name="registrarse">
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="text" name="apellido" placeholder="Apellido">
            <input type="date"name="fecha" placeholder="Fecha de nacimiento">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="pass" placeholder="Password">
            <button type="submit">Register</button>
        </form>
        <?php if(isset($_SESSION['Empy'])) {?> <p class="or">No puedes dejar espacios en blanco</p> <?php unset($_SESSION['Empy']); }?>
        <?php if(isset($_SESSION['existing_mail'])) {?> <p class="or">El correo ingresado ya existe</p> <?php unset($_SESSION['existing_mail']); }?>
        <?php if(isset($_SESSION['invalid_date'])) {?> <p class="or">Solo te puedes registrar si eras mayor de edad</p> <?php unset($_SESSION['invalid_date']); }?>
        <?php if(isset($_SESSION['Incorrect_pass'])) {?> 
        <p class="or">La contraseña es incorrecta: debe ser mayos a 13 caracteres y tener como minimo una mayuscula y 5 numeros</p> 
        <?php unset($_SESSION['Incorrect_pass']); }?>
        <div class="not-member">
            ya tienes cuenta? <a href="login.php">Inicia sesion ahora</a>
        </div>

    </div>
</body>

</html>