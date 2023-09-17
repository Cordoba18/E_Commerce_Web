@extends('customers.customerProfile')

@section('m-content')
    <section class="info-profile">
        <h3>Informacion personal</h3>
        @if (session('error'))
            {{ session('error') }}
         @endif
        <div class="target-profile">
            <div class="readView">
                <p><b>Nombre</b></p>
                <p>{{ $user->nombre }}</p>
            </div>
            @error('name')
            <h6>{{ $message }}</h6>
            @enderror
            <button class="editButton">Editar</button>
            <div class="editView">
                <form action="{{ route('customerprofile.store') }}" method="post">
                    @csrf
                    <input name="name" type="text" placeholder="nombre">
                    <input name="lastname" type="text" placeholder="Apellido">
                    <button type="button" class="cancelButton">Cancelar</button>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>

        <div class="target-profile">
            <div class="readView">
                <p><b>Correo</b></p>
                <p>{{ $user->correo }}</p>
            </div>
        </div>
        <div class="target-profile">
            <div class="readView">
                <p><b>Contraseña</b></p>
                <p>************</p>
            </div>
            <button class="editButton">Editar</button>
            <div class="editView">
                <form action="{{ route('customerprofile.store') }}" method="post">
                    @csrf
                    <input name="pass" type="text" placeholder="Contraseña actual">
                    <input name="passnow" type="text" placeholder="Contraseña nueva">
                    <input name="passnow_confirmation" type="text" placeholder="Confirmar contraseña">
                    <button type="button" class="cancelButton">Cancelar</button>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
        <div class="target-profile">
            <div class="readView">
                <p><b>Fecha de nacimiento</b></p>
                <p>{{ $user->f_nacimiento }}</p>
            </div>
        </div>
        <h3>Informacion de contacto</h3>
        <div class="target-profile">
            <div class="readView">
                <p><b>Identificacion</b></p>
                <p>{{ $user->N_Identificacion ? $user->N_Identificacion : 'no agregado' }}</p>
            </div>
            <button class="editButton">Editar</button>
            <div class="editView">
                <form action="{{ route('customerprofile.store') }}" method="post">
                    @csrf
                    <input name="nid" type="text" placeholder="N° identificacion">
                    <button type="button" class="cancelButton">Cancelar</button>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
        <div class="target-profile">
            <div class="readView">
                <p><b>Telefono</b></p>
                <p>{{ $user->telefono ? $user->telefono : 'no agregado' }}</p>
            </div>
            <button class="editButton">Editar</button>
            <div class="editView">
                <form action="{{ route('customerprofile.store') }}" method="post">
                    @csrf
                    <input name="numberphone" type="text" placeholder="N° celular">
                    <button type="button" class="cancelButton">Cancelar</button>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
        <div class="target-profile">
            <div class="readView">
                <p><b>Dirección</b></p>
                <p>{{ $user->direccion ? $user->direccion : 'no agregado' }}</p>
            </div>
            <button class="editButton">Editar</button>
            <div class="editView">
                <form action="{{ route('customerprofile.store') }}" method="post">
                    @csrf
                    <input name="address" type="text" placeholder="Direccion">
                    <button type="button" class="cancelButton">Cancelar</button>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </section>
@endsection
