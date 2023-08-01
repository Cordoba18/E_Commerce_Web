
<nav class="navbarcentral">
    <div class="columnone">
        <a href="{{route('home')}}">
            <img src="{{asset('storage/imgs/icon/Logo.png')}}" alt="">
            <h1>Style Sport</h1>
        </a>
        <button class="button-responsive">
            <i class="fa fa-bars i"></i>
        </button>
    </div>
    <div class="columntwo">
        <div class="columntwo-one">
            <form action="{{route('productcatalog')}}" method="get">
                <input type="text" name="search">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="columntwo-two">
            @auth
<<<<<<< HEAD
                <i class="fa-solid fa-cart-shopping"></i><p>carrrito</p>
                <i class="fa-solid fa-user"></i><a href="{{route('customerprofile')}}">Usuario</a>
=======
                <i class="fa-solid fa-cart-shopping"></i><a href="{{route('shoppingcart')}}">CARRITO</a>
                <i class="fa-solid fa-user"></i><p>usuario</p>
>>>>>>> 0903eb43bae793d8ec0832d96c79c4e56359037b
            @endauth
            @guest
                <a href="{{route('login')}}">Iniciar sesion</a>
                <a href="{{route('register')}}">Registrarse</a>
            @endguest
        </div>
    </div>
</nav>
<nav class="navbarbotton">
    <ul>
        <li><a href="{{route('productcatalog')}}">Camisetas</a></li>
        <li><a href="{{route('productcatalog')}}">Pantalones</a></li>
        <li><a href="{{route('productcatalog')}}">Zapatillas</a></li>
        <li><a href="{{route('productcatalog')}}">Mas +</a></li>
    </ul>
</nav>
