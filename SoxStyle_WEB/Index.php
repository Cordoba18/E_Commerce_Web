<?php include_once('BaseDatos/Conexion.php');  
$url = "./"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include('Librerias/Boostrap.php');
    include('Librerias/GliderLink.php');
    include('Librerias/FontawesoneLink.php');
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="Css/Footer.css">
    <link rel="stylesheet" href="Css/Principal.css">
    


    <title>Inicio</title>
</head>

<body>
    <header>
        <?php include('Complementos/Header.php'); ?>
    </header>
    <section>
        <?php include('Complementos/Slider.php'); ?>
    </section>
    <section>
        <article class="contenedor">
            <div class="carousel-productos">
                <div class="carousel-contenedor">
                    <p>Novedades <a href="">Ver mas</a></p>
                    <button aria-label="Anterior" class="carousel-anteriorD carousel-anterior">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <div class="carousel-listaD">
                        <?php
                        $sql = "SELECT * FROM productos ORDER BY RAND() DESC LIMIT 16";
                        include('Complementos/CarouselProductos.php');
                        ?>
                    </div>
                    <button aria-label="Siguiente" class="carousel-siguienteD carousel-siguiente">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <div role="tablist" class="carousel-indicadoresD carousel-indicadores"></div>
            </div>
        </article>
        <article class="contenedor">
            <div class="carousel-productos">
                <div class="carousel-contenedor">
                    <p>Destacados <a href="">Ver mas</a></p>
                    <button aria-label="Anterior" class="carousel-anteriorN carousel-anterior">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <div class="carousel-listaN">
                        <?php
                        $sql = "SELECT * FROM productos ORDER BY id DESC LIMIT 16";
                        include('Complementos/CarouselProductos.php');
                        ?>
                    </div>
                    <button aria-label="Siguiente" class="carousel-siguienteN carousel-siguiente">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <div role="tablist" class="carousel-indicadoresN carousel-indicadores"></div>
            </div>
        </article>
        <article class="contenedor">
            <div class="carousel-productos">
                <div class="carousel-contenedor">
                    <p>Ezquizofrenia <a href="">Ver mas</a></p>
                    <button aria-label="Anterior" class="carousel-anteriorF carousel-anterior">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <div class="carousel-listaF">
                        <?php
                        $sql = "SELECT * FROM productos LIMIT 16";
                        include('Complementos/CarouselProductos.php');
                        ?>
                    </div>
                    <button aria-label="Siguiente" class="carousel-siguienteF carousel-siguiente">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <div role="tablist" class="carousel-indicadoresF carousel-indicadores"></div>
            </div>
        </article>
    </section>
    <footer>
        <?php 
        include_once('Complementos/footer.php'); ?>
    </footer>
    <?php
    include('Librerias/GliderScript.php');
    include('Librerias/FontawesoneScript.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="JavaScript/CarouselProductos.js"></script>
    <script src="JavaScript/Iconos.js"></script>
    <script src="JavaScript/Slider.js"></script>
    <script src="JavaScript/Header.js"></script>
</body>

</html>