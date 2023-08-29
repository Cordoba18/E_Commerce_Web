<nav class="navbarcentral">
    <div class="columnone">
        <a href="{{ route('home') }}">
            <img src="{{ asset('storage/imgs/icon/Logo.png') }}" alt="">
        </a>
        <button class="button-responsive">
            <i class="fa fa-bars i"></i>
        </button>
    </div>
    <div class="columntwo">
        <div class="columntwo-three">
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
            </ul>
        </div>
        <div class="columntwo-one">
            <form action="{{ route('productcatalog') }}" method="get">
                <input type="text" name="search" placeholder="Buscar">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="columntwo-two">
            @auth
                <i class="fa-solid fa-user"></i><a href="{{ route('customerprofile') }}"></a>
                <i class="fa-solid fa-cart-shopping"></i><a href="{{ route('shoppingcart') }}"></a>
            @endauth
            @guest
                <a href="{{ route('login') }}">Iniciar sesion</a>
            @endguest
        </div>
        </div>
    </div>
</nav>
