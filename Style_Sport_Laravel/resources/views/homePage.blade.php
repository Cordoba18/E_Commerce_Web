@extends('layaouts.main')

@section('title', 'home')

@section('css')

@endsection

@section('content')

@include('layaouts.partials.navBar')

<h1>Inicio</h1>

@auth
<p>{{Auth::user()->nombre}}</p>

<form action="{{ Route('logout') }}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>

@endauth

@include('layaouts.partials.footer')

@endsection
