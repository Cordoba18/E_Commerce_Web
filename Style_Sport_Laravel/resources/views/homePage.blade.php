@extends('layaouts.main')

@section('title', 'home')

@section('content')

<h1>Inicio</h1>

@auth
<p>{{Auth::user()->nombre}}</p>

<form action="{{ Route('logout') }}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>

@endauth

@endsection
