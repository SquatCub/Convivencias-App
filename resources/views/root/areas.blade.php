@extends('layout.layout')
@section('titulo') Panel Super-Usuario @endsection
@section('section')
@include('root.navigation')
<h1>Secciones</h1>
<div class="text-right">
    <a href="{{ route ('seccion.new') }}" class="btn btn-warning">Añadir nueva sección</a>
</div>

<br>
@foreach($areas as $area)
    <h1>{{ $area }}</h1>
@endforeach

@endsection