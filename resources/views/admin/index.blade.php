@extends('layout.layout')
@section('titulo') Panel Administrador - Convivencias @endsection
@section('section')
@include('admin.navigation')
<br>
<div class="container text-center card">
    <h1>Bienvenido {{$admin->nombre}} {{$admin->apellido_paterno}} {{$admin->apellido_materno}}</h1>
    <h3>Aquí puedes gestionar categorías, actividades, solicitudes y usuarios del sistema</h3>
</div>

@endsection