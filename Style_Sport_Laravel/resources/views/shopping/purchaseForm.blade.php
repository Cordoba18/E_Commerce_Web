@extends('layaouts.main')

@section('title', 'formulario compras')

@section('css')
@vite(['resources/css/purchaseform.css'])
@endsection
@section('content')
<center><h1 style="font-size: 40px; padding: 40px">PAGINA DE COMPRAR</h1></center>
<p hidden id="user">{{ $id }}</p>
@php
    $total = 0;
@endphp
<table class="table">

    <thead>
        <th>NOMBRE</th>
        <th>TOTAL</th>
        <th>IMAGEN</th>
        <th>TALLA</th>
        <th>COLOR</th>
        <th>CANTIDAD</th>

    </thead>
    <tbody>
        @foreach($carrito as $c)
        <tr id="producto_carrito">
            <td>{{ $c->nombre }}</td>
            <td>{{ $c->total }}</td>
            <td>
                @php
                $total = $total + ($c->total * $c->cantidad_producto);
                $foundImage = false;
                $imagePath = '';
            @endphp

            @foreach ($Imagenes_productos as $img)
                @if ($img->id_producto == $c->id_producto)
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
            <td>{{ $c->talla }}</td>
            <td>{{ $c->color }}</td>
            <td>{{ $c->cantidad_producto }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>TOTAL = </h3><h2 id="total_full">{{ $total }}</h2>
<button id="finalizar_compra" class="btn btn-success"> FINALIZAR COMPRA </button>
 <center><div id="paypal-button-container">
    @csrf</div></center>

@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&components=buttons,funding-eligibility"></script>
<script>
let total = document.querySelector('#total_full').innerHTML;
let _token = document.querySelector('input[name=_token]').value;

setTimeout(() => {
alert('TIEMPO DE COMPRA EXPIRADO')
window.location.href = "{{ route('shoppingcart') }}";
}, 300000);
paypal.Buttons({
    fundingSource: paypal.FUNDING.CARD,
    createOrder: function(data, actions) {
        return actions.order.create({
            application_context: {
                shipping_preference: "NO_SHIPPING"
            },
            purchase_units: [{
                amount: {
                    value: total
                }
            }],
        });
    },
    onApprove: function(data, actions) {
        Swal.fire(
        'PAGO APROBADO',
         'Gracias por comprar con nosotros',
         'success'
        )
        $.ajax({
        type: 'POST',
        url: '{{ route("paymentmethod.facturar") }}',
        data: {
            paymentData: data,
            _token: _token // Enviar los datos devueltos por la API de PayPal
        },
        success: function(response) {
            // Manejar la respuesta del controlador si es necesario
            setTimeout(() => {
                window.location.href = "{{ route('shoppingcart') }}";
            }, 3000);

        },
        error: function(error) {
            // Manejar el error si lo hay
            console.error(error);
        }
    });
    },onCancel: function(data) {
        Swal.fire({
        icon: 'error',
        title: 'ERROR EN EL PAGO',
        text: 'Hubo un error con su pago!'
    })
    console.log(data);
}
}).render('#paypal-button-container');
</script>
@endsection
