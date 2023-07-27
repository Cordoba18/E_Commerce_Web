@extends('layaouts.app')

@section('title', 'registro')

<!--

-->

@section('content')

<form action="{{route('verification.validate')}}" method="post">
        @csrf
        <input type="number" name="digito" id="digito">
        
        <input type="submit" value="Enviar">
    </form>

@endsection