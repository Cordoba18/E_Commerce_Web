@extends('layaouts.main')

@section('title', 'lista de deseos')

@section('content')

<h1>lista de deseos</h1>


<table class="table">

    <thead>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>IMAGEN</th>
        <th>PRECIO</th>
        <th>ACCION</th>
    </thead>
    <tbody>
        @foreach ($lista_deseos as $l)
        <tr>
            <td>{{ $l->id }}</td>
            <td>{{ $l->nombre }}</td>
            <td>
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
            @endunless</td>
            <td>{{ $l->precio }}</td>
            <td><button class="btn btn-danger" id="btn_eliminar">ELIMINAR</button></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

