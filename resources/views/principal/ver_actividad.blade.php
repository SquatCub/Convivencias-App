@extends('layout.layout')
@section('titulo') Convivencias en linea @endsection
@section('navigation')
    @include('layout.navigation')
@endsection
@section('section')
<div class="container">
    <h1>{{$actividad->nombre}}</h1>
    <h3>{{$actividad->descripcion}}</h3>
    <h5>Categoría: {{$actividad->categoria->nombre}}</h5>
    <br>
    <div class="text-center">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/mK33FM54g7Q" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <br>
    
</div>

<div id="categoria">
    <div class="container">
    <br>
        <div class="text-center text-white">
            <h1>Comparte tu trabajo</h1>
        </div>
    </div>
    <br>
</div>
    
@endsection