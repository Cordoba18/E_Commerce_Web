<div class="container">
    <h3>Nuestras categorias</h3>
  <div class="swiper tranding-slider">
    <div class="swiper-wrapper">
      <!-- Slide-start -->
      @foreach ($categorys as $c)
      <div class="swiper-slide tranding-slide">
        <form action="{{ route('productcatalog') }}" method="get">
            <input type="hidden" name="search" value="{{ $c->categoria }}">
            <button style="border: 0" type="submit">
        <div class="tranding-slide-img">
            @php
            $foundImage = false;
            $imagePath = '';
        @endphp

        @foreach ($imgProduct as $img)
            @if ($img->id_producto == $c->id)
                @php
                    $imagePath = 'storage/imgs/' . $img->imagen;
                @endphp
                @if (file_exists(public_path($imagePath)))
                    <img src="{{ asset($imagePath) }}">
                    @php
                        $foundImage = true;
                    @endphp
                @endif
            @break
        @endif
    @endforeach

    @unless ($foundImage)
        <img src="{{ asset('storage/imgs/images.png') }}">
    @endunless
        </div>
        <div class="tranding-slide-content">
          <div class="tranding-slide-content-bottom">
            <h2 class="food-name">
             {{ $c->categoria }}
            </h2>
          </div>
        </div>
    </button>
        </form>
      </div>
      @endforeach
    </div>
    <div class="tranding-slider-control" >
      <div class="swiper-button-prev slider-arrow">
        <ion-icon name="arrow-back-outline"></ion-icon>
      </div>
      <div class="swiper-button-next slider-arrow">
        <ion-icon name="arrow-forward-outline"></ion-icon>
      </div>
      <div class="swiper-pagination"></div>
    </div>

  </div>
</div>
