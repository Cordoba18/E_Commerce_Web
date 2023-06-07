<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>login</title>
  <link rel="stylesheet" href="../Css/fForm.css">
</head>
<body>
  <div class="wrapper">
    <h1>Iniciar sesion</h1>
    <p>Bienvenido de nuevo!</p>
    <form action="../controlador/CtrlRegistroUsuario.php" method="post">
      <input type="hidden" name="loguearse">
      <input type="email" name="email" placeholder="Email">
      <input type="password" name="pass" placeholder="Password">
      <p class="recover">
        <a href="EnviarCod.php">Olvidaste tu contraseña?</a>
      </p>
      <button type="submit">Log in</button>
</form>
<?php if(isset($_SESSION['incorrect_login'])) {?> <p class="or">Correo o contraseña incorrectos</p> <?php unset($_SESSION['incorrect_login']); }?>
  <div class="not-member">
      <a href="../Index.php">Cancelar</a>
    </div>
    <div class="not-member">
      No tienes cuenta? <a href="Register.php">Registrate ahora</a>
    </div>
  </div>
</body>
</html>
