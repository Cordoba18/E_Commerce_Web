<?php session_start() ?>
<link rel="stylesheet" href="<?php echo $url ?>Css/Header.css">
<div>
    <nav class="navbar fondo-negro">
        <div class="container">
            <div class="info-contact">
                <div>
                    <i class="fa-solid fa-envelope contact-info"></i>
                    <a href="" class="navbar-sm-brand contact-info">info@gmail.com</a>
                    <i class="fa-solid fa-phone contact-info"></i>
                    <a href="" class="navbar-sm-brand contact-info">315-785-82-87</a>
                </div>
                <div>
                    <a href="" class="navbar-sm-brand contact-info"> <i class="fa-brands fa-facebook me-2"></i></a>
                    <a href="" class="navbar-sm-brand contact-info"><i class="fa-brands fa-instagram me-2"></i></a>
                    <a href="" class="navbar-sm-brand contact-info"><i class="fa-brands fa-twitter me-2"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="nav-header">
        <h1 class="h1">
            <a href="<?php echo $url; ?>Index.php" class="logo"><?php echo '<img src="'.$url.'img/Logo.png" class="img-logo">'; ?>Style sport</a>
        </h1>
        <button class="button">
            <i class="fa fa-bars i"></i>
        </button>
        <nav class="nav">
            <ul class="ul">
                <li class="li">
                    <form action="<?php echo $url; ?>vista/ListaProductos.php" class="buscador" method="get">
                        <input name="busqueda" type="text" class="buscador-input" placeholder="Search">
                        <button type="submit" class="buscador-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </li>
                <?php if (isset($_SESSION['User'])) { ?>
                    <li class="li"><a href="" class="carrito-icon"><i class="fa-solid fa-cart-shopping"></i></a></li>
                    <li class="li"><a href="controlador/CtrlSession.php"><img src="img/user-icon.png" class="icon-user"></a></li>
                <?php } else { ?>
                    <li class="li"><a href="<?php echo $url; ?>vista/Login.php" class="btn-login">Log in</a></li>
                    <li class="li"><a href="<?php echo $url; ?>vista/Register.php" class="btn-register">Register</a></li>
                <?php }  ?>
            </ul>
        </nav>
    </div>
    <div class="nav-inferior">
        <p>
            -
        </p>
        <button class="button-inferior">
            <i class="fa fa-bars i"></i>
        </button>
        <nav class="nav-inf">
            <ul class="ul">
                <li class="li"><a href="" class="a">Zapatillas</a></li>
                <li class="li"><a href="" class="a">Camisas</a></li>
                <li class="li"><a href="" class="a">Pantalones</a></li>
                <li class="li"><a href="" class="a">Todas+</a></li>

            </ul>
        </nav>
    </div>
</div>