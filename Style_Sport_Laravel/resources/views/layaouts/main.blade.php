<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- titulo --}}
    <title>@yield('title')</title>
    {{-- Bootstrap and Fontawesome--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    {{-- Css --}}
    @vite(['resources/css/navbar.css', 'resources/js/navBarResponsive.js'])
    @yield('css')
</head>
<body>
<<<<<<< HEAD
    
=======



>>>>>>> 0903eb43bae793d8ec0832d96c79c4e56359037b
    @include('layaouts.partials.navBar')

    @yield('content')

    @include('layaouts.partials.footer')

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@yield('js')
</html>
