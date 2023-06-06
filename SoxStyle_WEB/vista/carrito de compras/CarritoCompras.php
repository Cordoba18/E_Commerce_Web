
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
    
    <link rel="stylesheet" href="../carrito de compras/Estilo/K.css">

</head>

    <body>
        
    <div class="hd">
        <h4 class="car">Carrito ()</h4>
        <h4 class="fav">Favoritos()</h4>
        <button type="button" id="btn_vaciar" class="btn btn-primary btn-sm">vaciar carrito</button>
    </div>
    
    
    <div class="row" >
        <div class= "col-3"> 
            <div class="card"> 
                <div class="card-body">
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    <img class="card-img-top" src="/proyecto/E_Commerce_Web/images/zp.jpg">
                    <h4 >Nombre</h4>
                    <p class="card-text">precio</p>
                    <input type="number" class="sc">
                    <button class="btn btn-primary" id="btn_fav"  value="agregar" name="btnAccion" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                        </svg></button>
                </div>
            </div>
        </div>
    </div>

        <br>
        <br>

    <div class="centrar">
        <div class="comprar">
            <input class="total" type="number" value="total:" readonly placeholder="Total:">
                <br>
            <button class="btn btn-primary" id="btn_comprar" value="comprar" name="btnAccion" type="submit">Comprar</button>
        </div>
    </div>
    
    </body>
</html>