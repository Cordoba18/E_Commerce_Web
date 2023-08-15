@extends('layaouts.main')

@section('title', 'formulario compras')

@section('css')
@vite(['resources/css/purchaseform.css'])
@endsection
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="purchase_content">
<div class="content_left">
<h1 >FACTURA</h1>
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
            <td>${{ number_format(intval(round($c->total))) }}</td>
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
            @endunless</td>
            <td>{{ $c->talla }}</td>
            <td>{{ $c->color }}</td>
            <td>{{ $c->cantidad_producto }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>

<div class="content_right">
<span id="total_full" hidden>{{ $total }}</span>
<div class="contenedor_inputs">
    <h1>CONFIRMAR INFORMACION </h1>
    <label >TELEFONO </label>
    <input type="text" id="telefono" placeholder="INGRESE SU NUMERO DE TELEFONO" value="{{ $telefono }}">
    <p style="color: red" id="error_telefono" hidden></p>
    <label >DIRECCIÓN </label>
    <input type="text" id="direccion" placeholder="INGRESE SU NUMERO DIRECCIÓN" value="{{ $direccion }}">
    <p style="color: red" id="error_direccion" hidden></p>
    <label for="">DEPARTAMENTO</label>
    <select  id="departamentos">
        <option value="">SELECCIONE UN DEPARTAMENTO</option>
        @foreach ($departamentos as $d)
        <option value="{{ $d->id }}">{{ $d->departamento }}</option>
        @endforeach
    </select>
    <label for="">CIUDAD</label>
    <select id="ciudades">
        <option value="">SELECCIONE UNA CIUDAD</option>
    </select>

    <p style="color: red" id="error_ciudad" hidden></p>
    <h3>TOTAL  </h3><p class="total">${{ number_format(intval(round($total))) }} COP</p>

    <button id="finalizar_compra"> FINALIZAR COMPRA </button>
</div>

<div class="content-paypal-logos">

    <img src="{{ asset('storage/imgs/icon/MasterCard_Logo.png') }}">
    <img src="{{ asset('storage/imgs/icon/VISA-Logo.png') }}">
</div>


 <center><div id="paypal-button-container">
    @csrf</div></center>
</div>
</div>

@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://www.paypal.com/sdk/js?client-id=AW43i_XQWXydfHYWsv2dU-d15gMqO97p3-6trD_TlfaXmohDIS2u2Nyexa12qpgMG4OixEu2iCxIGb_n&currency=USD&components=buttons,funding-eligibility"></script>
@vite(['resources/js/purchaseForm.js'])
<script>
let total = document.querySelector('#total_full').innerHTML;
let _token = document.querySelector('input[name=_token]').value;
let total_dolares;

total_dolares = total * 0.0003098;
const validar = setInterval(() => {

    $.ajax({
        type: 'GET',
        url: '{{ route("purchaseform.validar") }}',
        success: function(response) {
            let total_absoluto = 0;


            response['seleccionados'].forEach(element => {

               total_absoluto = total_absoluto + (element.cantidad_producto * element.total)
            });
            // Manejar la respuesta del controlador si es necesari
            if (total_absoluto != total) {
                Swal.fire({
        icon: 'error',
        title: 'OCURRIO UN ERROR',
        text: 'Su carrito a cambiado!'
    })
    clearInterval(validar);
                window.location.href = "{{ route('purchaseform') }}";
            }
        },
        error: function(error) {
            // Manejar el error si lo hay
        }
    });
}, 3000);

setTimeout(() => {
alert('TIEMPO DE COMPRA EXPIRADO')
window.location.href = "{{ route('shoppingcart') }}";
}, 300000);





function cargarPaypal(){

    try {
paypal.Buttons({
    fundingSource: paypal.FUNDING.CARD,
    createOrder: function(data, actions) {
        return actions.order.create({
            application_context: {
                shipping_preference: "NO_SHIPPING"
            },
            purchase_units: [{
                amount: {
                    value:  Math.ceil(total_dolares)
                }
            }],
        });
    },
    onApprove: function(data, actions) {
        clearInterval(validar);
        $.ajax({
        type: 'POST',
        url: '{{ route("purchaseform.facturar") }}',
        data: {
            paymentData: data,
            _token: _token // Enviar los datos devueltos por la API de PayPal
        },
        success: function(response) {
              Swal.fire(
        'PAGO APROBADO',
         'Gracias por comprar con nosotros',
         'success'
        )
            // Manejar la respuesta del controlador si es necesario
            window.location.href = "{{ route('shoppinghistory') }}";

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
    });
}
}).render('#paypal-button-container');

} catch (error) {
    Swal.fire({
        icon: 'error',
        title: 'OCURRIO UN ERROR',
        text: 'RECARGANDO COMPRA'
    })
    clearInterval(validar);
    window.location.href = "{{ route('purchaseform') }}";
}

}



</script>
@endsection
