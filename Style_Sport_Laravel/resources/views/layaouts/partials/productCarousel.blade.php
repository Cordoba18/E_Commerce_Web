<a href="{{ route('productprofile', $P->id) }}">
    <div class="target">
        @if ($P->descuento > 0)
            <p class="discount">{{ $P->descuento }}% Off</p>
        @endif
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
        <img src="{{ asset('storage/imgs/images.png') }}">
    @endunless

    <div class="target-body">
        <h5 class="target-title">{{ $P->nombre }}</h5>
        @if ($P->descuento > 0)
            @php
                $porcentaje = ($P->precio * $P->descuento) / 100;
                $discount = $P->precio - $porcentaje;
            @endphp
            <div class="price">
                <p><span>${{ number_format(intval(round($discount))) }} </span>
                <p class="after"><span>${{ number_format(intval(round($P->precio))) }}</span></p>
                </p>
            </div>
        @else
            <p><span>$</span>{{ number_format(intval(round($P->precio))) }} </p>
        @endif
    </div>
</div>
</a>
