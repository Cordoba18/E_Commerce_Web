 <!-- Este codigo contiene la informacion de la factura enviada al correo del usuario para mostrar el detalle de su facura,
las restricciones y las redes sociales
-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACTURA</title>

</head>

<body style="font-family: Helvetica Neue, Arial y sans-serif; color: black">
    @php
        $total = 0;
    @endphp
    <center>
        <div class="content-facture" style="padding: 20px;border-radius: 5px;border: 0.5px solid gray; width: 700px;">
            <div class="content-header"
                style="background-color: red;
        display: flex;
        align-items: center;
        align-self: center;
        align-content: center;
        color: white;
        border-radius: 0px 0px 100px 0px;
        margin-bottom: 20px;">
                <img style="width: 240px; height: 180px; margin-top: 10px; margin-bottom: 10px; margin-left: 5px;"
                    src="https://style-sport.shop/storage/app/public/imgs/icon/Logo.png" alt="">
                <h1 style=" font-weight: bold; font-size: 60px">STYLE SPORT SHOP</h1>
            </div>
            <div class="content-body">
                <p style="
            margin-top: 10px;
            margin-left: 5px;">Hola, <span
                        style="font-weight: bold;">{{ $datos_usuario->nombre }}</span> te confirmamos la compra de tus
                    productos :</p>
                <h2 style=" font-size: 20px;
            text-align: center;
            margin: 20px;">DETALLE DE
                    FACTURA</h2>
                <br>
                <table class="table" style=" padding: 5px; width: 100%; text-align: center">

                    <thead>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>PRECIO</th>
                        <th>CANTIDAD</th>
                        <th>TALLA</th>
                        <th>COLOR</th>
                    </thead>
                    <tbody>
                        @foreach ($compras as $d)
                            <tr>

                                <td>{{ $d->id }}</td>
                                <td>{{ $d->nombre }}</td>
                                @php
                                    $total = $total + $d->total * $d->cantidad;
                                @endphp
                                <td>${{ number_format(intval(round($d->total))) }}</td>
                                <td>{{ $d->cantidad }}</td>
                                <td>{{ $d->talla }}</td>
                                <td>{{ $d->color }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <h3
                    style="   font-size: 20px;
            font-family: bold;
            font-weight: bold;
            font-size: 20px;
            border-bottom: 3px solid red;
            color: red;
            margin-left: 5px;
            width: max-content;">
                    TOTAL ${{ number_format(intval(round($total))) }}</h3>
                <div class="info_comprador" style="flex-wrap: wrap;">
                    <h5 style=" margin-top: 20px;width: 100%;font-weight: bold; font-size: 20px">INFOMACIÒN DEL COMPRADOR</h5><br>
                    <div style=" display: flex;width: 100%;">
                        <p style="font-weight: bold; width: 500px;">NOMBRE COMPLETO : </p>
                        <span>{{ $datos_usuario->nombre }}</span>
                    </div>
                    <div style=" display: flex; width: 100%;">
                        <p style="font-weight: bold;
                width: 500px; ">Telefono : </p>
                        <span>{{ $datos_usuario->telefono }}</span>
                    </div>
                    <div style=" display: flex; width: 100%;">
                        <p style="   font-weight: bold;
                    width: 500px;">NIT : </p>
                        <span>{{ $datos_usuario->N_Identificacion }}</span>
                    </div>
                    <div style=" display: flex; width: 100%;">
                        <p style="   font-weight: bold;
                width: 500px;">Direcciòn : </p>
                        <span>{{ $datos_usuario->direccion }}</span>
                    </div>
                    <div style=" display: flex; width: 100%;">
                        <p style="   font-weight: bold;
                width: 500px;">Ciudad : </p>
                        <span>{{ $datos_usuario->ciudades }}</span>
                    </div>
                    <div style=" display: flex; width: 100%;">
                        <p style="   font-weight: bold;
                width: 500px;">Correo : </p>
                        <span>{{ $datos_usuario->correo }}</span>
                    </div>
                    <div style=" display: flex; width: 100%;">
                        <p style="   font-weight: bold;
                width: 500px;">Horario de compra : </p>
                        <span>{{ $fecha_factura }}</span>
                    </div>

                </div>

            </div>
            <div class="content-fooder"
                style="     background-color: rgba(134, 134, 134, 0.3);
        flex-wrap: wrap;
        align-items: center;
        align-self: center;
        color: black;
        padding: 10px;">
                <div class="content-info">
                    <p> - Una vez finalizada la transacción y sin perjuicio del derecho de retracto en los estrictos
                        términos de la ley, Style Sport Shop no realizará devolución alguna de dinero,
                        ni se realizarán cambios en accesorios o productos. Una vez entregado el producto no se
                        realizara
                        devolución del dinero ni cambios.</p>
                    <p> - Para más información, consulta <a href="https://style-sport.shop/">Style Sport Shop</a>
                        informacion-legal, escríbenos a nuestro WhatsApp (+57)3043711546</p>
                </div>
                <div class="content-reds" style=" text-align: center;
            margin: 30px;">
                    <h6 style="        font-weight: bold; font-size: 15px">SIGUENOS EN NUESTRAS REDES</h6>
                    <a href="https://web.facebook.com/profile.php?id=61550475959912"><img
                            style="width: 30px; height: 30px; margin: 10px"
                            src="https://style-sport.shop/storage/app/public/imgs/icon/facebook.png" alt=""></a>
                    <a href="https://www.instagram.com/stylespo_208/"><img
                            style="width: 30px; height: 30px; margin: 10px"
                            src="https://style-sport.shop/storage/app/public/imgs/icon/instagram.png"
                            alt=""></a>
                    <a href="https://twitter.com/stylespo_208"><img style="width: 30px; height: 30px; margin: 10px"
                            src="https://style-sport.shop/storage/app/public/imgs/icon/twitter.png" alt=""></a>
                </div>
            </div>
        </div>
    </center>
</body>

</html>
