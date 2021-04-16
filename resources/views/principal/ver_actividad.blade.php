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
            <h2>Sube una foto de tu tabajo para que todos puedan verla</h2><br>
            <form action="{{ route ('comentario.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="text-center">
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <div class="mr-3">
                        <label>
                        <input type="file" size="200" name="imagen" id="imagen" onchange="loadFile(event)" accept="image/x-png,image/gif,image/jpeg">
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
                            <img src="https://cdn.blankstyle.com/files/imagefield_default_images/notfound_0.png" alt="preview" width="100" id="output"/>
                        </div>
                    </div>
                    <br>
                    <input type="hidden" name="id_actividad" value="{{$actividad->id}}" >
                    <input type="hidden" name="id_usuario" value="{{Auth::user()->id}}">
                    <button type="submit" class="btn btn-success btn-lg">Compartir</button>
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
                <div class="col myImg{{$comentario->imagen}} d-none d-md-block">
                    <div class="wrapper-photo">
                        <div class="container">
                            <div class="photo-top" style="background: url('/images/{{$comentario->imagen}}') no-repeat center center;">
                            </div>
                            <div class="photo-bottom">
                                <h4>Por: {{$comentario->usuario->nombre}} {{$comentario->usuario->apellido_paterno}} {{$comentario->usuario->apellido_materno}}</h4>
                                <h5>De: {{$comentario->usuario->area->nombre}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col myImg{{$comentario->imagen}} d-sm-block d-md-none d-lg-none">
                    <div class="wrapper-photo-sm">
                        <div class="container">
                            <div class="photo-top" style="background: url('/images/{{$comentario->imagen}}') no-repeat center center;">
                            </div>
                            <div class="photo-bottom">
                                <h6>Por: {{$comentario->usuario->nombre}} {{$comentario->usuario->apellido_paterno}}</h6>
                                <h7>De: {{$comentario->usuario->area->nombre}}</h7>
                            </div>
                        </div>
                    </div>
                </div>
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
    }
  };
</script>
<!-- The Modal -->
<div id="myModal" class="modal-img">
  <!-- The Close Button -->
  <span class="close">&times;</span>
  <!-- Modal Content (The Image) -->
  <img class="modal-img-content" id="img01">
  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>

@foreach($comentarios as $comentario)
<!-- Script para visualizar las imagenes -->
<script>
  var modal = document.getElementById("myModal");
  var img1 = document.getElementsByClassName("myImg{{$comentario->imagen}}");
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  img1[0].onclick = function() {
    modal.style.display = "block";
    modalImg.src = '/images/{{$comentario->imagen}}';
    captionText.innerHTML = "<h1>{{$comentario->usuario->nombre}} {{$comentario->usuario->apellido_paterno}} de {{$comentario->usuario->area->nombre}}</h1>";
  }
  img1[1].onclick = function() {
    modal.style.display = "block";
    modalImg.src = '/images/{{$comentario->imagen}}';
    captionText.innerHTML = "<h1>{{$comentario->usuario->nombre}} {{$comentario->usuario->apellido_paterno}} de {{$comentario->usuario->area->nombre}}</h1>";
  }
  var span = document.getElementsByClassName("close")[0];
  span.onclick = function() {
    modal.style.display = "none";
  }
</script>
@endforeach
@endsection