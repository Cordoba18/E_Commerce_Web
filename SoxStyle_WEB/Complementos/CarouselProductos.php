
<?php
$conectar = conectar();
$productos = mysqli_query($conectar,$sql);
$imagen = mysqli_fetch_array($productos);

$id = $imagen['id'];

if (isset($_SESSION['User'])) {
    $id_user = $_SESSION['User'];

    $sql = mysqli_query($conectar, "SELECT * FROM favoritos WHERE id_user= '$id_user' AND id_productos = '$id'");

    $no_of_rows = mysqli_num_rows($sql);

    if ($no_of_rows > 0) {
        $class = "si-fav fa-solid";
    } else {
        $class = "no-fav fa-regular";
    }

    $sql2 = mysqli_query($conectar, "SELECT * FROM carrito WHERE id_user= '$id_user' AND id_productos = '$id'");

    $no_of_rows2 = mysqli_num_rows($sql2);

    if ($no_of_rows2 > 0) {
        $class2 = "cart-agg";
    } else {
        $class2 = "cart-clear";
    }
    $bottons =  '<button class="ico ico-carrito">
                                    <i class="fa-solid fa-cart-shopping ' . $class2 . ' carrito"></i>                             
                                </button>
                                <input type="hidden" name="id" class="id-product" value= "' . $imagen['id'] . '" >
                                <button  class= "ico icon-corazon">
                                    <i class="corazon ' . $class . ' fa-heart"></i>
                                </button>';
} else {
    $bottons =  '<button class="ico"></button>
                <button  class= "ico"></button>';
}

echo '<div class="card product" style="width: 18rem;">
                            <a href="vista/principal_p.php"><img src="' . $imagen['img'] . '" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <a href="">             
                                    <p class="card-text p-precio-producto"><b>$</b>' . $imagen['precio'] . '</p>
                                    <p class="card-text p-envio-gratis"> Envio gratis</p>
                                    <p class="card-text p-nombre-producto">' . $imagen['nombre'] . '</p>
                                </a>
                                ' . $bottons . '
                            </div>
                        </div>';
while ($img = mysqli_fetch_array($productos)) {

    $id = $img['id'];

    if (isset($_SESSION['User'])) {
        $id_user = $_SESSION['User'];

        $sql = mysqli_query($conectar, "SELECT * FROM favoritos WHERE id_user= '$id_user' AND id_productos = '$id'");

        $no_of_rows = mysqli_num_rows($sql);

        if ($no_of_rows > 0) {
            $class = "si-fav fa-solid";
        } else {
            $class = "no-fav fa-regular";
        }

        $sql2 = mysqli_query($conectar, "SELECT * FROM carrito WHERE id_user= '$id_user' AND id_productos = '$id'");

        $no_of_rows2 = mysqli_num_rows($sql2);

        if ($no_of_rows2 > 0) {
            $class2 = "cart-agg";
        } else {
            $class2 = "cart-clear";
        }
        $bottons =  '<button class="ico ico-carrito">
                                        <i class="fa-solid fa-cart-shopping ' . $class2 . ' carrito"></i>                             
                                    </button>
                                    <input type="hidden" name="id" class="id-product" value= "' . $img['id'] . '" >
                                    <button  class= "ico icon-corazon">
                                        <i class="corazon ' . $class . ' fa-heart"></i>
                                    </button>';
    } else {
        $bottons =  '<button class="ico"></button>
                                    <button  class= "ico"></button>';
    }
    echo '<div class="card product" style="width: 18rem;">
                                <a href="vista/principal_p.php"><img src="' . $img['img'] . '" class="card-img-top" alt="..."></a>   
                                <div class="card-body"> 
                                    <a href="">             
                                        <p class="card-text p-precio-producto"><b>$</b>' . $img['precio'] . '</p>
                                        <p class="card-text p-envio-gratis"> Envio gratis</p>
                                        <p class="card-text p-nombre-producto">' . $img['nombre'] . '</p>
                                    </a>
                                    ' . $bottons . '
                                </div>
                            </div>';
}

mysqli_close($conectar); 