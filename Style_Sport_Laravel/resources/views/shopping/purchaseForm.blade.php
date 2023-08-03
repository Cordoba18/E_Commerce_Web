@extends('layaouts.app')

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
<div id="paypal-button-container"></div>


@endsection

@section('js')
<script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
<script>
paypal.Buttons({

// Order is created on the server and the order id is returned

createOrder() {

  return fetch("/my-server/create-paypal-order", {

    method: "POST",

    headers: {

      "Content-Type": "application/json",

    },

    // use the "body" param to optionally pass additional order information

    // like product skus and quantities

    body: JSON.stringify({

      cart: [

        {

          sku: "YOUR_PRODUCT_STOCK_KEEPING_UNIT",

          quantity: "YOUR_PRODUCT_QUANTITY",

        },

      ],

    }),

  })

  .then((response) => response.json())

  .then((order) => order.id);

},

// Finalize the transaction on the server after payer approval

onApprove(data) {

  return fetch("/my-server/capture-paypal-order", {

    method: "POST",

    headers: {

      "Content-Type": "application/json",

    },

    body: JSON.stringify({

      orderID: data.orderID

    })

  })

  .then((response) => response.json())

  .then((orderData) => {

    // Successful capture! For dev/demo purposes:

    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

    const transaction = orderData.purchase_units[0].payments.captures[0];

    alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);

    // When ready to go live, remove the alert and show a success message within this page. For example:

    // const element = document.getElementById('paypal-button-container');

    // element.innerHTML = '<h3>Thank you for your payment!</h3>';

    // Or go to another URL:  window.location.href = 'thank_you.html';

  });

}

}).render('#paypal-button-container');

</script>
@endsection
