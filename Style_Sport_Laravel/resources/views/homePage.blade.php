@extends('layaouts.main')

@section('title', 'home')

@section('css')

@endsection

@section('content')

@include('layaouts.partials.navBar')

@include('layaouts.partials.slider')

<h1>Inicio</h1>

@auth
<p>{{Auth::user()->nombre}}</p>

<form action="{{ Route('logout') }}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>

@endauth

@include('layaouts.partials.productCarousel')

@include('layaouts.partials.footer')

@section('js')
<script src="glider.js"></script>
@endsection

@endsection
