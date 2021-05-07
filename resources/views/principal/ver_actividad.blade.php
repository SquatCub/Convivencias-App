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
<div class="container">
    <div class="video-container">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$actividad->video_url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>

<br>
<div id="categoria">
    <div class="container">
    <br>
        <div class="text-center text-white">
            <h1>Comparte tu trabajo</h1>
            @if(Auth::user())
            <h2>Sube una foto de tu trabajo para que todos puedan verlo</h2><br>
            <form action="{{ route ('comentario.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="text-center">
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <div class="mr-3">
                        <label>
                        <input type="file" required size="200" name="file" id="imagen" onchange="loadFile(event)" accept="image/x-png,image/gif,image/jpeg">
                            <div class="wrapper-upload">
                                <div class="container">
                                    <div class="upload-top" style="background: url('/images/app/upload.png') no-repeat center center;">
                                    </div>
                                    <div class="upload-bottom">
                                        <h4>Seleccionar</h4>
                                    </div>
                                </div>
                            </div>
                        </label>
                        </div>
                        <div class="ml-3">
                            <img src="/images/app/notfound.png" alt="preview" width="100" id="output"/>
                        </div>
                    </div>
                    <br>
                    <input type="hidden" name="id_actividad" value="{{$actividad->id}}" >
                    <input type="hidden" name="id_usuario" value="{{Auth::user()->id}}">
                    <input type="hidden" name="tipo" value="imagen">
                    <button id="share" type="submit" class="btn btn-success btn-lg" disabled>Compartir</button>
                </div>
            </form>
            <br>
            <h2>Sube un video</h2>
            <form action="{{ route ('comentario.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="text-center">
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <div class="mr-3">
                        <label>
                        <input type="file" required size="200" name="file" id="video" onchange="loadVideo(event)" accept="video/mp4, video/mov">
                            <div class="wrapper-upload">
                                <div class="container">
                                    <div class="upload-top" style="background: url('/images/app/upload.png') no-repeat center center;">
                                    </div>
                                    <div class="upload-bottom">
                                        <h4>Seleccionar</h4>
                                    </div>
                                </div>
                            </div>
                        </label>
                        </div>
                        <br>
                    </div>
                    <span id="outputVideo">Ningún video seleccionado</span>
                    <br>
                    <br>
                    <input type="hidden" name="id_actividad" value="{{$actividad->id}}" >
                    <input type="hidden" name="id_usuario" value="{{Auth::user()->id}}">
                    <input type="hidden" name="tipo" value="video">
                    <button id="shareVideo" type="submit" class="btn btn-success btn-lg" disabled>Compartir</button>
                </div>
            </form>
            @else
            <h2 class="text-warning">Necesitas estar registrado e iniciar sesión para compartir tu trabajo</h2>
            <br>
            @endif
        </div>
    </div>
    <br>
</div>
<div id="actividad">
    <div class="container">
    <br>
        <div class="text-center text-white">
            <h1>Galería de trabajos</h1>
            <br>
            <div class="row">
                @foreach($comentarios as $comentario)
                @if($comentario->tipo == "imagen")
                <div class="col" id="myImg{{$comentario->path}}">
                    <div class="wrapper-photo">
                        <div class="container">
                            <div class="photo-top" style="background: url('/images/{{$comentario->path}}') no-repeat center center;">
                            </div>
                            <div class="photo-bottom">
                                <h4>Por: {{$comentario->usuario->nombre}} {{$comentario->usuario->apellido_paterno}} {{$comentario->usuario->apellido_materno}}</h4>
                                <h5>De: {{$comentario->usuario->area->nombre}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($comentario->tipo == "video")
                <div class="col myVid{{$comentario->path}}">
                    <div class="wrapper-photo">
                        <div class="container">
                            <video src="/videos/{{$comentario->path}}" controls width="300" height="350"></video>
                            <div class="photo-bottom">
                                <h4>Por: {{$comentario->usuario->nombre}} {{$comentario->usuario->apellido_paterno}} {{$comentario->usuario->apellido_materno}}</h4>
                                <h5>De: {{$comentario->usuario->area->nombre}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            
        </div>
    </div>
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
<script>
  var loadFile = event => {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
      document.getElementById("share").disabled = false;
    }
  };
  var loadVideo = event => {
    var output = document.getElementById('outputVideo');
    output.innerHTML = event.target.files[0].name;
    document.getElementById("shareVideo").disabled = false;
  };
</script>
<!-- The Modal -->
<div id="myModal" class="modal-img">
  <!-- The Close Button -->
  <span class="close" id="close" on>&times;</span>
  <!-- Modal Content (The Image) -->
  <img class="modal-img-content" id="img01">
  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>

@foreach($comentarios as $comentario)
<!-- Script para visualizar las imagenes -->
@if($comentario->tipo=="imagen")
<script>
  var modal = document.getElementById("myModal");
  var img1 = document.getElementById("myImg{{$comentario->path}}");
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  img1.onclick = function() {
    modal.style.display = "block";
    modalImg.src = '/images/{{$comentario->path}}';
    captionText.innerHTML = "<h1>{{$comentario->usuario->nombre}} {{$comentario->usuario->apellido_paterno}} de {{$comentario->usuario->area->nombre}}</h1>";
  }
  var span = document.querySelector("#close");
  span.onclick = function() {
    modal.style.display = "none";
    console.log("click")
  }
</script>
@endif
@endforeach
@endsection