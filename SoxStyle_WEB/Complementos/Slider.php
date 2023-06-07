<div class="swiper contenedor">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <?php
    $conectar = conectar();
    $imagenes = mysqli_query($conectar, "SELECT * FROM slider");
    $imagen = mysqli_fetch_array($imagenes);
    echo  '<div class="swiper-slide">
            <img src="', $imagen['url'], '">
          </div>';
    while ($img = mysqli_fetch_array($imagenes)) {
      echo  '<div class="swiper-slide">
    <img src="', $img['url'], '">
  </div>';
    }
    mysqli_close($conectar);
    ?>


  </div>
  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>

  <!-- If we need navigation buttons -->
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>

</div>