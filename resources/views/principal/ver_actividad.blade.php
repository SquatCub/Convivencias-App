@extends('layout.layout')
@section('titulo') Convivencias en linea @endsection
@section('navigation')
    @include('layout.navigation')
@endsection
@section('section')
<br>
    <div class="container">
        <h1 class="display-4 titulo2">Actividad: {{$actividad->nombre}}</h1>
        <h3>{{$actividad->descripcion}}</h3>
        <div class="d-flex justify-content-between">
            <h5>Categoría: {{$actividad->categoria->nombre}}</h5>
            <h5 class="fecha">Fecha: {{$actividad->created_at}}</h5>
        </div>
        
    </div>
    <br>
<br>

<div class="text-center">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$actividad->video_url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <br>
<div id="categoria">
    <div class="container">
    <br>
        <div class="text-center text-white">
            <h1>Comparte tu trabajo</h1>
            <h2>Sube una foto de tu tabajo para que todos puedan verla</h2>
            <!-- @if(Auth::user())
            <h1>Logeado</h1>
            @else
            <h2>Necesitas estar registrado e iniciar sesión para compartir tu trabajo</h2>
            @endif -->
        </div>
    </div>
    <br>
</div>
<script>
    desc = document.querySelectorAll('.fecha');
    desc.forEach(element=> {
        var aux = "";
        var s = element.innerHTML;
        var i = 0;
        for (i = 0; i < 17; i++) {
            aux+= s[i];
        }
        element.innerHTML = aux;
    });
</script>
@endsection