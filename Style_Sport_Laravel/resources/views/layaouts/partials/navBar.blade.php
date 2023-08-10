<nav class="navbarcentral">
    <div class="columnone">
        <a href="{{ route('home') }}">
            <img src="{{ asset('storage/imgs/icon/Logo.png') }}" alt="">
            <h1>Style Sport</h1>
        </a>
        <button class="button-responsive">
            <i class="fa fa-bars i"></i>
        </button>
    </div>
    <div class="columntwo">
        <div class="columntwo-one">
            <form action="{{ route('productcatalog') }}" method="get">
                <input type="text" name="search">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="columntwo-two">
            @auth

                <i class="fa-solid fa-user"></i><a href="{{ route('customerprofile') }}">Usuario</a>
                <i class="fa-solid fa-cart-shopping"></i><a href="{{ route('shoppingcart') }}">CARRITO</a>
            @endauth
            @guest
                <a href="{{ route('login') }}">Iniciar sesion</a>
                <a href="{{ route('register') }}">Registrarse</a>
            @endguest
        </div>
    </div>
</nav>
<nav class="navbarbotton">
    <ul>
        <li>
            <form action="{{ route('productcatalog') }}" method="get">
                <input type="hidden" name="search" value="Camisetas deportivas">
                <button class="links" type="submit">Camisetas</button>
            </form>
        </li>
        <li>
            <form action="{{ route('productcatalog') }}" method="get">
                <input type="hidden" name="search" value="Pantalones deportivos">
                <button class="links" type="submit">Pantalones</button>
            </form>
        </li>
        <li>
            <form action="{{ route('productcatalog') }}" method="get">
                <input type="hidden" name="search" value="Zapatillas de deporte">
                <button class="links" type="submit">Zapatillas</button>
            </form>
        </li>
        <li>
            <form action="{{ route('productcatalog') }}" method="get">
                <input type="hidden" name="search" value="">
                <button class="links" type="submit">Mas +</button>
            </form>
        </li>
    </ul>
</nav>
