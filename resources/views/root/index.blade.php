@extends('layout.layout')
@section('titulo') Panel Super-Usuario @endsection
@section('section')
@include('root.navigation')
<br>
<div class="container text-center card">
    <h1>Bienvenido {{$root->nombre}} {{$root->apellido_paterno}} {{$root->apellido_materno}}</h1>
    <h3>En esta pagina puedes gestionar Administradores, Secciones y Super Usuarios</h3>
</div>

@endsection