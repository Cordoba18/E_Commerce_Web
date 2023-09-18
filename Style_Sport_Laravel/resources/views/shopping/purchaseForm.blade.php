@extends('layaouts.main')
<!-- extiendo de la plantilla-->
<!-- div para la animacion de carga-->
<div id="content-carga">
</div>

<!-- Agredo un titulo a la seccion de la plantilla-->
@section('title', 'formulario compras')
<!-- Agrego la seccion de el css para la plantilla-->
@section('css')
<!-- importo el CSS especifico para esta vista por medio de la ruta de viteconfig -->
    @vite(['resources/css/purchaseform.css'])
@endsection
<!-- Agrego el contenido para la plantilla-->
@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <div class="purchase_content">
        <div class="content_left">
            <h1>FACTURA</h1>
            <!-- id del usuario oculto -->
            <p hidden id="user">{{ $id }}</p>
            <!-- variable para capturar el total de los productos -->
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
                    <!-- impresion de la informacion del formulario de compra -->
                    @foreach ($carrito as $c)
                        <tr id="producto_carrito">
                            <td>{{ $c->nombre }}</td>
                            <td>${{ number_format(intval(round($c->total))) }}</td>
                            <td class="img_product">
                                        <!--calculacion del total y manejo de las imagenes -->
                                @php
                                    $total = $total + $c->total * $c->cantidad_producto;
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
                            @endunless
                        </td>
                        <td>{{ $c->talla }}</td>
                        <td>{{ $c->color }}</td>
                        <td>{{ $c->cantidad_producto }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <!--formulario para la confirmacion de la compra en la cual imprimo cierta informacion del usuario -->
    <div class="content_right">
        <span id="total_full" hidden>{{ $total }}</span>
        <div class="contenedor_inputs">
            <h1>CONFIRMAR INFORMACIÒN </h1>
            <label>TELÈFONO </label>
            <div style="display: flex">
                <input type="text" id="telefono" placeholder="INGRESE SU NUMERO DE TELEFONO"
                    value="{{ $telefono }}">
            </div>
            <p style="color: red" id="error_telefono" hidden></p>
            <label>NIT </label>
            <input type="text" id="identificacion" placeholder="INGRESE SU NUMERO DE IDENTIFICACIÒN"
                value="{{ $N_Identificacion }}">
            <p style="color: red" id="error_identificacion" hidden></p>
            <label>DIRECCIÓN </label>
            <input type="text" id="direccion" placeholder="INGRESE SU NUMERO DIRECCIÓN" value="{{ $direccion }}">
            <p style="color: red" id="error_direccion" hidden></p>
            <label for="">DEPARTAMENTO</label>
            <select id="departamentos">
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
            <h3>TOTAL </h3>
            <p class="total">${{ number_format(intval(round($total))) }} COP</p>

            <button id="finalizar_compra"> FINALIZAR COMPRA </button>
        </div>

        <div class="content-paypal-logos">

            <img src="{{ asset('storage/imgs/icon/MasterCard_Logo.png') }}">
            <img src="{{ asset('storage/imgs/icon/VISA-Logo.png') }}">
        </div>


    <!--contenedor del formulario de paypal -->
        <center>

            <div id="paypal-button-container">
                @csrf</div>
        </center>
    </div>
</div>

@endsection
<!-- abro la seccion del javascript para la plantilla-->
@section('js')
<!-- importo por medio de cdn JQUERY -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- accedo a una appi en la cual le especifico el modo prueba con el id del cliente de paypal para la llegada del dinero -->
<script
    src="https://www.paypal.com/sdk/js?client-id=AW43i_XQWXydfHYWsv2dU-d15gMqO97p3-6trD_TlfaXmohDIS2u2Nyexa12qpgMG4OixEu2iCxIGb_n&components=buttons,funding-eligibility">
</script>
<!-- importo el javascript especifico para esta vista por medio de la ruta de viteconfig -->
@vite(['resources/js/purchaseForm.js'])
<script>

    let total = document.querySelector('#total_full').innerHTML;
    let _token = document.querySelector('input[name=_token]').value;
    let paypal_content = document.querySelector('#paypal-button-container');
    let total_dolares;
    //calculo para volver el precio total a la conversion de dolares especifica que tiene paypal
    total_dolares = total * 0.0003098;
    //contador que se repite cada 3 segundos para validar que no hay cambios en alguno de los productos a comprar
    const validar = setInterval(() => {
         //accedo a la ruta por metodo get con ayuda de ajax
        $.ajax({
            type: 'GET',
            url: '{{ route('purchaseform.validar') }}',
            success: function(response) {
                    //con la respuesta valido si el total de los productos a sido alterado para recargar la vista
                let total_absoluto = 0;


                response['seleccionados'].forEach(element => {

                    total_absoluto = total_absoluto + (element.cantidad_producto * element
                        .total)
                });
                // Manejar la respuesta del controlador si es necesario
                if (total_absoluto != total) {
                    clearInterval(validar);
                    Swal.fire({
                        icon: 'error',
                        title: 'OCURRIO UN ERROR',
                        text: 'Su carrito a cambiado!'
                    })
                    //detener el contador
                    clearInterval(validar);
                    //pasado 3 segundos recarga la vista
                    setTimeout(() => {
                    window.location.href = "{{ route('purchaseform') }}";
                }, 3000);
                }
            },
            error: function(error) {
                // Manejar el error si lo hay
            }
        });
    }, 3000);

    //cuando pasen 5 minutos expira el plazo para comprar y se redirecciona al carrito de compras
    setTimeout(() => {
        clearInterval(validar);
        alert('TIEMPO DE COMPRA EXPIRADO')
        window.location.href = "{{ route('shoppingcart') }}";
    }, 600000);



    let carga = document.querySelector("#content-carga");
//cargar los botones de paypal
    function cargarPaypal() {

        try {
            paypal.Buttons({
                //fundingSource: paypal.FUNDING.CARD,
                createOrder: function(data, actions) {
                    return actions.order.create({
                        application_context: {
                            shipping_preference: "NO_SHIPPING"
                        },
                        purchase_units: [{
                            amount: {
                                value: Math.ceil(total_dolares)
                            }
                        }],
                    });
                },
                onApprove: function(data, actions) {
                    //se cumple la compra correctamente
                    //se detiene el contador que valida el cambio del formulario
                    clearInterval(validar);
                    //se remueve el contenedor de paypal
                    paypal_content.remove();
                    //se agregar el codigo para la animacion de carga
                    carga.innerHTML = "<div class='content-fondo-cargando'>" +
                        "<div class='content-cargando'>" +
                        "<img src='{{ asset('storage/imgs/icon/Cargando.gif') }}'>" +
                        "</div>" +
                        "</div>";
                        //se accede a la ruta de la facturacion
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('purchaseform.facturar') }}',
                        data: {
                            paymentData: data,
                            _token: _token // Enviar los datos devueltos por la API de PayPal
                        },
                        success: function(response) {
                            //se cumple la facturación
                            //se elimina la animacion de carga
                            carga.remove();
                            //muestra un mensaje de aporbacion
                            Swal.fire(
                                'PAGO APROBADO',
                                'Gracias por comprar con nosotros',
                                'success'
                            )
                            // despues de 2 segundos lo redicciona al historial de compras
                            setTimeout(() => {
                                window.location.href =
                                "{{ route('shoppinghistory') }}";
                            }, 2000);
                        },
                        error: function(error) {
                            //si hay un error en la facturacion
                            //remueve la animacion de carga
                            carga.remove();
                            //muestra un mensaje
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR EN EL PAGO',
                                text: 'Hubo un error con su pago!'
                            });
                            //recarga la vista
                            window.location.href = "{{ route('purchaseform') }}";
                        }
                    });
                },
                onCancel: function(data) {
                     //si hay un error en el pago
                            //se quita la animacion de carga
                            carga.innerHTML = "";
                            //muestra un mensaje
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR EN EL PAGO',
                                text: 'Hubo un error con su pago!'
                            });
                            //recarga la vista
                }
            }).render('#paypal-button-container');

        } catch (error) {
            //si hay un error al cargar los botones muestra un mensaje y despues de 3 segundos recarga la vista
            Swal.fire({
                icon: 'error',
                title: 'OCURRIO UN ERROR',
                text: 'RECARGANDO COMPRA'
            })
            clearInterval(validar);
            setTimeout(() => {
            window.location.href = "{{ route('purchaseform') }}";
        }, 3000);
        }

    }
</script>
@endsection
