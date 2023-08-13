@extends('customers.customerProfile')

@section('title', 'lista de deseos')

@section('m-content')

<h1>LISTA DE DESEOS</h1>

<table class="table">

    <thead>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>IMAGEN</th>
        <th>PRECIO</th>
        <th>ACCION</th>
    </thead>
    <tbody>
        @forelse ($lista_deseos as $l)
        <tr id="productos">
            <td id="id_lista_deseos">{{ $l->id }}</td>
            <td>{{ $l->nombre }}</td>
            <td><a href="{{route('productprofile', $l->id_producto)}}">
                @php
                $foundImage = false;
                $imagePath = '';
            @endphp

            @foreach ($Imagenes_productos as $img)

                @if ($img->id_producto == $l->id_producto)
                    @php
                        $imagePath = 'storage/imgs/' . $img->imagen;
                    @endphp
                    @if (file_exists(public_path($imagePath)))
                        <img  style="width: 300px; height: 180px;" src="{{ asset($imagePath) }}">
                        @php
                            $foundImage = true;
                        @endphp
                    @endif
                    @break
                @endif
            @endforeach

            @unless ($foundImage)
                <img style="width: 300px; height: 180px; " src="{{ asset('storage/imgs/images.png') }}">
            @endunless
        </a></td>
            <td>${{ number_format(intval(round($l->precio))) }}</td>
            <td><button class="btn btn-danger" id="btn_eliminar">ELIMINAR</button></td>
        </tr>
        @empty
                <h1>No hay resultados productos en tu lista de deseos</h1>
            @endforelse
    </tbody>
</table>


@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
@vite(['resources/js/WishList.js'])

@endsection
