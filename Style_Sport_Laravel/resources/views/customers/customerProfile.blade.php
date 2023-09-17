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
                        <li><a href="{{ route('customerprofile') }}"><i class="fa-solid fa-user"></i> Informaciòn de usuario</a></li>
                        <li><a href="{{ route('shoppinghistory') }}"><i class="fa-solid fa-file"></i> Historial de compras</a></li>
                        <li><a href="{{ Route('wishlist') }}"><i class="fa-solid fa-list"></i> Lista de deseos</a></li>
                        <li>
                            <form action="{{ Route('customer.delete') }}" method="get"><button class="btn-delete" type="submit"><i class="fa-solid fa-trash"></i>Eliminar cuenta</button></form>
                        </li>

                    </ul>
                </aside>
                <a class="logout" href="{{ Route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesiòn</a>
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
