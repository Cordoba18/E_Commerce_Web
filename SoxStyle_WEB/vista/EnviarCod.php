<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/estilos.css">
    <title>Document</title>
</head>
<body>
<br>
<div class="contenedor">
  <br>
  <br>
  <h1>Recuperar contraseña</h1>
  <h2>Digita tu correo electronico para poder continuar</h2>

<form action="cod_verify.php" method="POST">
    <div class="form-group">
    <label for="inputEmail3"><strong>Correo Electronico</strong></label>
    <br>
    <input type="email" name="passEmail" id="inputEmail3" class="form-control">
    <button type="submit" class="boton">Enviar codigo</button>
    </div>
</form>
</div>

</body>
</html>