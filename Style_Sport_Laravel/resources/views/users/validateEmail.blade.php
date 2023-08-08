@extends('layaouts.app')

@section('title', 'registro')

<!--

-->

@section('content')

<p hidden id="datos">{{ $datos }}</p>
<form action="{{route('verification.validate')}}" method="post">
        @csrf
        <input type="number" name="digito" id="digito">

        <h1></h1>
        <input type="submit" value="Enviar">
    </form>

@endsection


@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
@vite(['resources/js/VerificationEmail.js'])
@endsection
