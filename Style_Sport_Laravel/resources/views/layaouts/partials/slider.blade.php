<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-inner">

        @php
            $imagePath = '';
            $active = true;
        @endphp

        @foreach ($slider as $s)
            @php
                $imagePath = 'storage/imgs/' . $s->imagen;
                $imageInfo = @getimagesize(public_path($imagePath));
            @endphp
            @if ($imageInfo !== false)
                <div class="carousel-item @if ($active) active @endif">
                    <img src="{{ asset($imagePath) }}" class="img">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $s->nombre }}</h5>
                        <p>{{ $s->info }}</p>
                    </div>
                </div>
            @else
                <div class="carousel-item @if ($active) active @endif">
                    <img src="{{ asset('storage/imgs/banner-def.jpeg') }}" class="img">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $s->nombre }}</h5>
                        <p>{{ $s->info }}</p>
                    </div>
                </div>
            @endif
            @php
                $active = false;
            @endphp
        @endforeach

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
