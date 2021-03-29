@extends('layout.layout')
@section('titulo') Convivencias en linea @endsection
@section('navigation')
    @include('layout.navigation')
@endsection
@section('section')
<h1>Principal</h1>
@if(isset($usuario->normal))
    <h1>Iniciaste sesion como usuario</h1>
@endif
@endsection