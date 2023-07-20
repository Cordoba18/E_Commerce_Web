@extends('layaouts.main')

@section('title', 'producto catalogo')

@section('content')

@foreach ($productos as $p )
    {{$p->nombre}} <br>
@endforeach

@endsection
