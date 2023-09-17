 <!-- Este codigo contiene la informacion de el envio de los codigos alteranando el mensaje para diferencia si es para cambiar contraseña o creacion de cuenta.
    Tambien contiene las redes sociales
-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACTURA</title>
</head>
<body style=" font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
  <center>
    <div class="content-facture" style="     padding: 20px;
    border-radius: 5px;
    border: 0.5px solid gray;
    width: 700px;">
        <div class="content-header" style="  background-color: red;
        display: flex;
        align-items: center;
        align-self: center;
        color: white;
        border-radius: 0px 0px 100px 0px;
        margin-bottom: 20px;
    ">
            <img style="     width: 240px;
            height: 180px;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 5px;" src="https://style-sport.shop/public/storage/imgs/icon/Logo.png" alt="">
            <h1 style=" font-weight: bold; font-size: 60px">STYLE SPORT SHOP</h1>
        </div>
        <div class="content-body">
            <p style="
            margin-top: 10px;
            margin-left: 5px; font-size: 15px">Hola, <span style="  font-weight: bold;">{{ $nombre}}</span>{{ $mensaje }}</p>
            <br>


            <center><div class="info_codigo" style="text-align: center;
              border: 1px solid black;
              width: 300px;
              align-items: center;
              align-self: center;
              align-content: center;
              margin: 20px;">
               <h2 style=" background-color: red;
               color: white;
               padding: 10px; font-size: 30px">CODIGO</h2>
               <p style="   font-weight: bold; font-size: 25px">{{ $cod }}</p>
            </div></center>

            <p class="advertencia" style="   text-align: center;
            border-bottom: 3px solid red;
            width: max-content;
            width: 100%;
            color: red;
            font-family: bold;
            font-weight: bold;
            font-size: 25px;
            margin-top: 40px;">!ADVERTENCIA! EL CODIGO CADUCA EN 5 MINUTOS</p>
        </div>
        <div class="content-fooder" style="   background-color: rgba(134, 134, 134, 0.3);
        flex-wrap: wrap;
        align-items: center;
        align-self: center;
        color: black;
        padding: 10px;">

            <div class="content-reds" style=" text-align: center;
            margin: 30px;">
                    <h6 style="        font-weight: bold; font-size: 15px">SIGUENOS EN NUESTRAS REDES</h6>
                    <a href="https://web.facebook.com/profile.php?id=61550475959912"><img
                            style="width: 30px; height: 30px; margin: 10px"
                            src="https://style-sport.shop/public/storage/imgs/icon/facebook.png" alt=""></a>
                    <a href="https://www.instagram.com/stylespo_208/"><img
                            style="width: 30px; height: 30px; margin: 10px"
                            src="https://style-sport.shop/public/storage/imgs/icon/instagram.png"
                            alt=""></a>
                    <a href="https://twitter.com/stylespo_208"><img style="width: 30px; height: 30px; margin: 10px"
                            src="https://style-sport.shop/public/storage/imgs/icon/twitter.png" alt=""></a>
                </div>
        </div>
    </div></center>
</body>
</html>
