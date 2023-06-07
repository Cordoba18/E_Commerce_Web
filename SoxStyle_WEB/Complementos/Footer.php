<link rel="stylesheet" href="<?php echo $url ?>Css/Footer.css">
<div class="pie-pagina">
    <div class="grupo-1">
        <div class="box">
            <figure>
                <a href="#" class="logo"><?php echo '<img src="'.$url.'img/Logo.png" class="img-logo">'; ?>
                    <p>Style sport</p>
                </a>
            </figure>
        </div>
        <div class="box">
            <h2>MAS CONTENIDO</h2>
            <ul class="list-footer">
                <li class="li"><a href="<?php echo $url; ?>Index.php" class="a">Inicio</a></li>
                <?php if (isset($_SESSION['User'])) { ?>
                    <li class="li"><a href="#" class="a">Perfil</a></li>
                <?php } else { ?>
                    <li class="li"><a href="<?php echo $url; ?>vista/Login.php" class="a">Log in</a></li>
                <?php }  ?>
                <li class="li"><a href="#" class="a">Categorias</a></li>
                <li class="li"><a href="#" class="a">About</a></li>
                <li class="li"><a href="#" class="a">Ayuda</a></li>
                <li class="li"><a href="#" class="a">Terminos y condiciones</a></li>
            </ul>
        </div>
        <div class="box">
            <h2>SIGUENOS</h2>
            <div class="red-social">
                <a href="#"> <i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
    </div>
    <div class="grupo-2">
        <small>&copy; 2023 <b>Style sport</b> - Todos los Derechos Reservados.</small>
    </div>
</div>