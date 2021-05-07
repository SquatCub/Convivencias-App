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
    <div class="col myImg{{$comentario->path}} d-none d-md-block">
        <div class="wrapper-photo">
            <div class="container">
                <div class="photo-top" style="background: url('/images/{{$comentario->path}}') no-repeat center center;">
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
    <div class="col myImg{{$comentario->path}} d-sm-block d-md-none d-lg-none">
        <div class="wrapper-photo-sm">
            <div class="container">
                <div class="photo-top" style="background: url('/images/{{$comentario->path}}') no-repeat center center;">
                    <div class="text-right">
                        <button class="btn btn-sm btn-danger text-right" data-toggle="modal" data-target="#modalDelete{{ $comentario->id }}">Eliminar</button>
                    </div>
                </div>
                <div class="photo-bottom">
                    <h6>Por: {{$comentario->usuario->nombre}} {{$comentario->usuario->apellido_paterno}}</h6>
                    <h7>De: {{$comentario->usuario->area->nombre}}</h7>
                </div>
            </div>
        </div>
    </div>



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
                    <h4>¿Está seguro de querer la imagen?</h4><br>
                    <h5><b>La compartió:</b> {{ $comentario->usuario->nombre }} {{ $comentario->usuario->apellido_paterno }} {{ $comentario->usuario->materno }} de {{ $comentario->usuario->area->nombre }}</h5>
                    <hr>
                    <b>Esta acción no se podrá deshacer.</b>
                    <b>Se eliminarán todas las imagenes que se compartieron en esta actividad.</b>
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

@foreach($comentarios as $comentario)
<!-- Script para visualizar las imagenes -->
<script>
  var modal = document.getElementById("myModal");
  var img1 = document.getElementsByClassName("myImg{{$comentario->path}}");
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  img1[0].onclick = function() {
    modal.style.display = "block";
    modalImg.src = '/images/{{$comentario->path}}';
    captionText.innerHTML = "<h1>{{$comentario->usuario->nombre}} {{$comentario->usuario->apellido_paterno}} de {{$comentario->usuario->area->nombre}}</h1>";
  }
  img1[1].onclick = function() {
    modal.style.display = "block";
    modalImg.src = '/images/{{$comentario->path}}';
    captionText.innerHTML = "<h1>{{$comentario->usuario->nombre}} {{$comentario->usuario->apellido_paterno}} de {{$comentario->usuario->area->nombre}}</h1>";
  }
  var span = document.getElementsByClassName("close2")[0];
  span.onclick = function() {
    modal.style.display = "none";
  }
</script>
@endforeach
@endsection