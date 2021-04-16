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
@endsection