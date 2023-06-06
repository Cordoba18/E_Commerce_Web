<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0.">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrito de compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand">Sox Style</a>
            <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="my-nav" class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link"  href="#">Inicio <span class="sr-only"></span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- FIN DEL NAVBAR -->

        <br>
        <br>
        <br>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Carrito(1)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Favoritos()</a>
            </li>
        </ul>

        <div class="row" >
        <div class= "col-3">
        <div class="card">
            <img class="card-img-top" src="/proyecto/E_Commerce_Web/imagenes/imagen.jpg" alt="">
            <div class="card-body">
                <h4 >Nombre</h4>
                <h5 class="card-title">Descripcion</h5>
                <p class="card-text">precio</p>
                <button class="btn btn-primary" value="agregar" name="btnAccion" type="submit">Favoritos</button>
            </div>
        <br>
        <br>
        <h2>Total:</h2>
        <button class="btn btn-primary"  value="comprar" name="btnAccion" type="submit">Comprar</button>
    </body>
</html>