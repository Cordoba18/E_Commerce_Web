<div class="swiper contenedor">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        @foreach ($slider as $s)
        <div class="swiper-slide">
          <img class="img" src="{{ asset('storage/imgs/'.$s->imagen) }}">
      </div>
        @endforeach

    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

</div>
