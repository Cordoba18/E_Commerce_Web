@foreach ($Product as $P)
    <div class="target">
        @php
            $foundImage = false;
            $imagePath = '';
        @endphp

        @foreach ($imgProduct as $img)
            @if ($img->id_producto == $P->id)
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
            <img src="{{ asset('storage/imgs/image_icon-icons.com_50366.png') }}">
        @endunless

        <div class="card-body">
            <h5 class="card-title">{{ $P->nombre }}</h5>
            <p class="card-text">{{ $P->descripcion }}</p>
            <a href="#" class="btn btn-primary">Ver mas</a>
        </div>
    </div>
@endforeach


