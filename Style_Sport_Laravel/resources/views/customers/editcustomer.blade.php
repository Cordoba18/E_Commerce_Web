@extends('customers.customerProfile')

@section('m-content')

<section class="info-profile">
    <h3>Informacion personal</h3>
    <div class="target-profile">
        <p><b>Nombre</b></p>
        <p>{{ $user->nombre }}</p>
        <button>Editar</button>
    </div>
    <div class="target-profile">
        <p><b>Correo</b></p>
        <p>{{ $user->correo }}</p>
    </div>
    <div class="target-profile">
        <p><b>Contraseña</b></p>
        <p>************</p>
    </div>
    <div class="target-profile">
        <p><b>Fecha de nacimiento</b></p>
        <p>{{ $user->f_nacimiento }}<p>
    </div>
    <h3>Informacion de contacto</h3>
    <div class="target-profile">
        <p><b>Identificacion</b></p>
        <p>{{ $user->Identificacion ? $user->Identificacion : 'no agregado' }}</p>
    </div>
    <div class="target-profile">
        <p><b>Telefono</b></p>
        <p>{{ $user->telefono ? $user->telefono : 'no agregado' }}</p>
    </div>
    <div class="target-profile">
        <p><b>Ciudad</b></p>
        <p>{{ $city->ciudades ? $city->ciudades : 'no agregado' }}</p>
    </div>
    <div class="target-profile">
        <p><b>Dirección</b></p>
        <p>{{ $user->direccion ? $user->direccion : 'no agregado' }}</p>
    </div>
</section>
@endsection