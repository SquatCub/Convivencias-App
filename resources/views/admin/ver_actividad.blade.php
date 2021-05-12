@extends('layout.layout2')
@section('titulo') Editar actividad @endsection
@section('section')
@include('admin.navigation')

<div class="container card">
<br>
    <div class="text-right">
        <a href="{{ route ('actividad.edit', $actividad) }}" class="btn btn-warning btn-sm">Editar</a>
    </div>
    <h1>Nombre de la actividad: {{$actividad->nombre}}</h1>
    <h4>Categoría: {{$actividad->categoria->nombre}}</h4>
    <h4>Descripción: {{$actividad->descripcion}}</h4>
    <hr>
    <h4>Video: </h4>
    <div class="container">
        <div class="video-container">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$actividad->video_url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    <br>
</div>
<br>
<div class="container card">
    <h3>Imagenes compartidas</h3>
    <div class="row">
    @foreach($comentarios as $comentario)
    @if($comentario->tipo=="imagen")
    <div class="col" id="myImg{{$comentario->path}}">
        <div class="wrapper-photo">
            <div class="container">
                <div class="photo-top" onclick="showImg(this)" data-img="/images/{{$comentario->path}}" data-by="{{$comentario->usuario->nombre}} {{$comentario->usuario->apellido_paterno}} de {{$comentario->usuario->area->nombre}}" style="background: url('/images/{{$comentario->path}}') no-repeat center center;">
                    <div class="text-right">
                        <button class="btn btn-sm btn-danger text-right"  data-toggle="modal" data-target="#modalDelete{{ $comentario->id }}">Eliminar</button>
                    </div>
                </div>
                <div class="photo-bottom">
                    <h4>Por: {{$comentario->usuario->nombre}} {{$comentario->usuario->apellido_paterno}} {{$comentario->usuario->apellido_materno}}</h4>
                    <h5>De: {{$comentario->usuario->area->nombre}}</h5>
                </div>
            </div>
        </div>
    </div>
    @elseif($comentario->tipo=="video")
    <div class="col">
        <div class="wrapper-photo">
            <div class="container">
                    <div class="text-right">
                        <button class="btn btn-sm btn-danger text-right"  data-toggle="modal" data-target="#modalDelete{{ $comentario->id }}">Eliminar</button>
                    </div>
                <video src="/videos/{{$comentario->path}}" controls width="300" height="350"></video>
                <div class="photo-bottom">
                    <h4>Por: {{$comentario->usuario->nombre}} {{$comentario->usuario->apellido_paterno}} {{$comentario->usuario->apellido_materno}}</h4>
                    <h5>De: {{$comentario->usuario->area->nombre}}</h5>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="modal fade" id="modalDelete{{ $comentario->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmación de eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <h4>¿Está seguro de querer el archivo?</h4><br>
                    <h5><b>La compartió:</b> {{ $comentario->usuario->nombre }} {{ $comentario->usuario->apellido_paterno }} {{ $comentario->usuario->materno }} de {{ $comentario->usuario->area->nombre }}</h5>
                    <hr>
                    <b>Esta acción no se podrá deshacer</b>
            </div>
            <div class="modal-footer">
                <form action="{{ route('comentario.eliminar', $comentario) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-default btn-raised" data-dismiss="modal">Cancelar</button>
                    <button type="sumbmit" class="btn btn-warning btn-raised" id="cursos-confirm-delete">Eliminar</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    @endforeach
    </div>
</div>
<!-- The Modal -->
<div id="myModal" class="modal-img">
  <!-- The Close Button -->
  <span class="close close2">&times;</span>
  <!-- Modal Content (The Image) -->
  <img class="modal-img-content" id="img01">
  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
@endsection