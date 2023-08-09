@extends('layaouts.main')

@section('title', 'perfil usuario')

@section('css')
    @vite(['resources/css/customerprofile.css'])
@endsection

@section('content')

    <main class="main">
        <div class="profile">
            <div class="navegation-profile">
                <aside>
                    <h2>Mi cuenta</h2>
                    <ul>
                        <li><a href="{{ route('customerprofile') }}">Informacion de usuario</a></li>
                        <li><a href="{{ route('shoppinghistory') }}">Historial de compras</a></li>
                        <li><a href="{{ Route('wishlist') }}">Lista de deseos</a></li>
                        <li><a href="{{ Route('logout') }}">Cerrar sesion</a></li>
                        <li><a href="{{ Route('customer.delete') }}">Eliminar cuenta</a></li>

                    </ul>
                </aside>
            </div>
            <div class="panel">
                @yield('m-content')
            </div>
        </div>
    </main>

@endsection

@section('js')
    @vite(['resources/js/customer.js'])
@endsection
