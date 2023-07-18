<div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
        @foreach ($slider as $s)
            <div class="carousel-item active">
                <img src="{{asset('storage/imgs/'.$s->imagen)}}">
          </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>