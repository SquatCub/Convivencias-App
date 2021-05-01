@extends('layout.layout2')
@section('titulo') Panel Administrador - Actividades @endsection
@section('section')
@include('admin.navigation')
<div class="container card">
    <br>
    <h1>Galería de fotos</h1>
    <div class="text-right">
        <a href="{{ route ('foto.new') }}" class="btn btn-success text-white">Añadir nueva foto</a>
    </div>
    <br>
    @foreach($fotos as $foto)
        <h1>Foto</h1>
    @endforeach
</div>
@endsection