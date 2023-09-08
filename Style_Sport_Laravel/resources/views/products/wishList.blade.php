@extends('customers.customerProfile')
 <!-- Extiendo de la plantilla
-->

<!-- Agredo un titulo a la seccion de la plantilla-->
@section('title', 'lista de deseos')
<!-- Agrego el contenido para la plantilla-->
@section('m-content')

<h1>LISTA DE DESEOS</h1>

<table class="">

    <thead>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>IMAGEN</th>
        <th>PRECIO</th>
        <th>ACCION</th>
    </thead>
    <tbody>
        @forelse ($lista_deseos as $l)
        <!-- Muestro la informacion de la lista de deseos que viene del controlador-->
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
                        <img  src="{{ asset($imagePath) }}">
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
        </a></td>
            <td>${{ number_format(intval(round($l->precio))) }}</td>
            <td><button class="btn btn-danger btn-sm" id="btn_eliminar">ELIMINAR</button></td>
        </tr>
        @empty
              <!-- Si no viene ningun dato se muestra un titulo que le confirma al usuario que no tiene productos en la lista de deseos-->
                <h1>No hay resultados productos en tu lista de deseos</h1>
            @endforelse
    </tbody>
</table>


@endsection

<!-- abro la seccion del javascript para la plantilla-->
@section('js')
<!-- importo por medio de cdn JQUERY -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<!-- importo el javascript especifico para esta vista por medio de la ruta de viteconfig -->
@vite(['resources/js/WishList.js'])

@endsection
