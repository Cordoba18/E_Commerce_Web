<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/codigo.css">
    <title>Document</title>
</head>
<body>

<div class="contenedor">
  <br>
  <br>
  <br>
<h1>Ingrese el codigo de verificacion</h1>
<div class="form-group">
    <form action="" method="POST">
      <strong>
    <input type="text" id="digito1" name="digito1" maxlength="1" oninput="autofocusNext(this, 'digito2')">

    <input type="text" id="digito2" name="digito2" maxlength="1" oninput="autofocusNext(this, 'digito3')">

    <input type="text" id="digito3" name="digito3" maxlength="1" oninput="autofocusNext(this, 'digito4')">

    <input type="text" id="digito4" name="digito4" maxlength="1">
    </strong>
    <br>
    <br>

    <button type="submit" class="boton">Siguiente</button>
    </form>
    </div>
</div>
<script src="../JavaScript/codigo.js"></script>
</body>
</html>