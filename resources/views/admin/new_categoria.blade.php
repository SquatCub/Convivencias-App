@extends('layout.layout')
@section('titulo') Crear nueva categoría @endsection
@section('section')
@include('admin.navigation')

<div class="container text-center card">
    <h1>Crear nueva categoría</h1>

    <form action="{{ route ('categoria.create') }}" method="post" enctype="multipart/form-data">
        @csrf <!-- Seguridad laravel -->
        <div class="col-sm-12">
            <div class="panel panel-default">
                <br>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label for="no_de_control" class="control-label">Nombre de la categoría</label>
                            <input type="text" class="form-control text-center" name="nombre" id="nombre_categoría">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label for="no_de_control" class="control-label">Descripción</label>
                            <textarea type="text" rows="2" class="form-control" name="descripcion"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <div class="form-group label-floating">
                            <label class="custom-file-upload mr-3">
                                <input type="file" size="200" name="imagen" id="imagen" onchange="loadFile(event)" accept="image/x-png,image/gif,image/jpeg">
                                Seleccionar imagen
                            </label>
                            <img src="https://cdn.blankstyle.com/files/imagefield_default_images/notfound_0.png" alt="preview" width="70" id="output"/>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <br>
        <div class="col-sm-12 text-right">
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-raised btn-sm">Cancelar</a>
            <button type="submit" class="btn btn-primary btn-raised btn-sm">Guardar</button>
        </div>
        <br>
    </form>
</div>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
@endsection