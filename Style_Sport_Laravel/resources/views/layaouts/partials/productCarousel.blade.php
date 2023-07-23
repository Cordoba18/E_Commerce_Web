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

        <div class="target-body">
            <h5 class="target-title">{{ $P->nombre }}</h5>
            <p class="target-text">${{ $P->precio }}</p>
            <p class="target-text">Envio gratis</p>
        </div>
    </div>
@endforeach


