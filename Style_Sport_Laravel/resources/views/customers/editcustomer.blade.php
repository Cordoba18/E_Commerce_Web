@extends('customers.customerProfile')

@section('m-content')

<section class="info-profile">
    <h3>Informacion personal</h3>
    <div class="target-profile">
        <p><b>Nombre</b></p>
        <p>{{ $user->nombre }}</p>
        <button>Editar</button>
        <div>
            <form action="{{ route('customerprofile.store') }}" method="post">
                @csrf
                <input name="name" type="text" placeholder="nombre">
                <input name="lastname" type="text" placeholder="Apellido">
                <button type="submit">Cancelar</button>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
    <div class="target-profile">
        <p><b>Correo</b></p>
        <p>{{ $user->correo }}</p>
    </div>
    <div class="target-profile">
        <p><b>Contraseña</b></p>
        <p>************</p>
        <button>Editar</button>
        <div>
            <form action="{{ route('customerprofile.store') }}" method="post">
                @csrf
                <input name="pass" type="text" placeholder="Contraseña actual">
                <input name="passnow" type="text" placeholder="Contraseña nueva">
                <input name="passnow_confirmation" type="text" placeholder="Confirmar contraseña">
                <button type="submit">Cancelar</button>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
    <div class="target-profile">
        <p><b>Fecha de nacimiento</b></p>
        <p>{{ $user->f_nacimiento }}<p>
    </div>
    <h3>Informacion de contacto</h3>
    <div class="target-profile">
        <p><b>Identificacion</b></p>
        <p>{{ $user->Identificacion ? $user->Identificacion : 'no agregado' }}</p>
        <button>Editar</button>
        <div>
            <form action="{{ route('customerprofile.store') }}" method="post">
                @csrf
                <input name="nid" type="text" placeholder="N° identificacion">
                <button type="submit">Cancelar</button>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
    <div class="target-profile">
        <p><b>Telefono</b></p>
        <p>{{ $user->telefono ? $user->telefono : 'no agregado' }}</p>
        <button>Editar</button>
        <div>
            <form action="{{ route('customerprofile.store') }}" method="post">
                @csrf
                <input name="numberphone" type="text" placeholder="N° celular">
                <button type="submit">Cancelar</button>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
    <div class="target-profile">
        <p><b>Dirección</b></p>
        <p>{{ $user->direccion ? $user->direccion : 'no agregado' }}</p>
        <button>Editar</button>
        <div>
            <form action="{{ route('customerprofile.store') }}" method="post">
                @csrf
                <input name="address" type="text" placeholder="Direccion">
                <button type="submit">Cancelar</button>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
</section>
@endsection