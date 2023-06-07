<?php $url = "../";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/pagina_perfil.css.css" />

    <title>Perfil</title>
</head>
<?php include_once('../Complementos/Header.php') ?>
<body>
    <nav>
        <a href="Perfil.html">Perfiles</a>
        <a href="../METODO DE PAGO/Metodo-de-pago.html">Metodos de pago</a>
        <a href="">Historial de compras</a>
    </nav>
    <div class="contenido">
        <section>
            <div>
                <img class="profile-img" style="width: 19%;" src="https://cdn-icons-png.flaticon.com/512/552/552721.png" alt="Profile image">
            </div>
            <br><br>
            <article class="metodos">
                <div class="form-group">

                    <label for="nombre">Nombre:</label>

                    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" readonly>
                    <img class="edit-btn" style="width: 2.7%;" src="https://img.freepik.com/iconos-gratis/lapiz_318-189722.jpg?w=2000" alt="Edit button">

                </div>
                <br>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>

                    <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>" readonly>
                    <img class="edit-btn"  style="width: 2.7%;" src="https://img.freepik.com/iconos-gratis/lapiz_318-189722.jpg?w=2000" alt="Edit button">

                </div>
                <br>
                <div class="form-group">
                    <label for="correo">Correo electrónico:</label>

                    <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>" readonly>
                    <img class="edit-btn" style="width: 2.7%;" src="https://img.freepik.com/iconos-gratis/lapiz_318-189722.jpg?w=2000" alt="Edit button">

                </div>
                <br>
                <div class="form-group">
                    <label for="numero">Número:</label>

                    <input type="tel" id="numero" name="numero" value="<?php echo $numero; ?>" readonly>
                    <img class="edit-btn" style="width: 2.7%;" src="https://img.freepik.com/iconos-gratis/lapiz_318-189722.jpg?w=2000" alt="Edit button">

                </div>
                <br>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>

                    <input type="text" id="direccion" value="<?php echo $direccion; ?>" name="direccion" readonly>
                    <img class="edit-btn" style="width: 2.7%;" src="https://img.freepik.com/iconos-gratis/lapiz_318-189722.jpg?w=2000" alt="Edit button">

                </div>
                <br>
                <div>
                    <button type="submit" class="save-btn">Guardar</button>
                </div>
            </article>
        </section>
    </div>
    <script src="script.js"></script>
</body>
<?php include_once('../Complementos/Footer.php') ?>
</html>