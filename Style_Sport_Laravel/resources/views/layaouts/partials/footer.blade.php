<div class="pie-pagina">
    <div class="grupo-1">
        <div class="box">
            <figure>
                <a href="{{route('home')}}" class="logo">
                    <img src="{{asset('storage/imgs/icon/Logo.png')}}" alt="">
                    <p>Style sport</p>
                </a>
            </figure>
        </div>
        <div class="box">
            <h2>MÀS CONTENIDO</h2>
            <ul class="list-footer">
                <li class="li"><a href="{{route('home')}}" class="a">Inicio</a></li>
                @auth
                <li class="li"><a href="{{route('customerprofile')}}" class="a">Perfil</a></li>
                @endauth
                @guest
                <li class="li"><a href="{{route('login')}}" class="a">Iniciar sesiòn</a></li>
                <li class="li"><a href="{{route('register')}}" class="a">Registrarse</a></li>
                @endguest
                <li id="btn_about" class="li"><a href="#" class="a">About</a></li>
                <li id="btn_ayuda" class="li"><a href="#" class="a">Ayuda</a></li>
                <li id="btn_terminos_condiciones" class="li"><a href="#" class="a">Tèrminos y condiciones</a></li>
                <li id="btn_descargar_apk" class="li"><a href="#" class="a">Descargar app aquí</a></li>
            </ul>
        </div>
        <div class="box">
            <h2>SÌGUENOS</h2>
            <div class="red-social">
                <a href="https://web.facebook.com/profile.php?id=61550475959912"> <i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/stylespo_208/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://twitter.com/stylespo_208"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
    </div>
    <div class="grupo-2">
        <small>&copy; 2023 <b>Style sport</b> - Todos los Derechos Reservados.</small>
    </div>
</div>
