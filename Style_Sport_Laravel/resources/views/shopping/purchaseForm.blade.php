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

<div></div>

<div class="contenedor_inputs">
    <h4>CONFIRMAR INFORMACION :</h4>
    <label >TELEFONO: </label>
    <input type="text" id="telefono" placeholder="INGRESE SU NUMERO DE TELEFONO" value="{{ $telefono }}">
    <p style="color: red" id="error_telefono" hidden></p>
    <br><br>
    <label >DIRECCION: </label>
    <input type="text" id="direccion" placeholder="INGRESE SU NUMERO DIRECCION" value="{{ $direccion }}">
    <p style="color: red" id="error_direccion" hidden></p>
    <br><br>

    <button id="finalizar_compra" class="btn btn-success"> FINALIZAR COMPRA </button>
</div>


 <center><div id="paypal-button-container">
    @csrf</div></center>

@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&components=buttons,funding-eligibility"></script>
<script>
let total = document.querySelector('#total_full').innerHTML;
let _token = document.querySelector('input[name=_token]').value;


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
        url: '{{ route("purchaseform.facturar") }}',
        data: {
            paymentData: data,
            _token: _token // Enviar los datos devueltos por la API de PayPal
        },
        success: function(response) {
            // Manejar la respuesta del controlador si es necesario
            clearInterval(validar);
            window.location.href = "{{ route('shoppingcart') }}";


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
 ;
}
}).render('#paypal-button-container');
}



let finalizar_compra = document.querySelector("#finalizar_compra");

finalizar_compra.addEventListener("click", function(e){
    
    let error_telefono = document.querySelector("#error_telefono");
    let error_direccion = document.querySelector("#error_direccion");
    let contenedor_inputs = document.querySelector(".contenedor_inputs");
        let telefono = document.querySelector('#telefono');
        let direccion = document.querySelector('#direccion');
        if (telefono.value < 0 ||telefono.value == null || telefono.value == "" ) {
            error_telefono.removeAttribute('hidden')
            error_telefono.innerHTML = "TELEFONO VACIO";
            
        }
        else if (direccion.value == "") {
            error_direccion.removeAttribute('hidden')
            error_direccion.innerHTML = "DIRECCION VACIA";
        }else {
        contenedor_inputs.remove();
        cargarPaypal();
        $.ajax({
        type: 'POST',
        url: '{{ route("purchaseform.save_changes") }}',
        data: {
            telefono: telefono,
            direccion: direccion,
            _token: _token // Enviar los datos devueltos por la API de PayPal
        },
        success: function(response) {
            // Manejar la respuesta del controlador si es necesario


        },
        error: function(error) {
            // Manejar el error si lo hay
            console.error(error);
        }
    });

    }
           
            

  
    
})
</script>
@endsection
