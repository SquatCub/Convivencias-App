@extends('layout.layout2')
@section('titulo') Crear nueva categoría @endsection
@section('section')
@include('admin.navigation')

<div class="container text-center card">
    <h1>Agregar nueva foto</h1>

    <form action="{{ route ('foto.create') }}" method="post" enctype="multipart/form-data">
        @csrf <!-- Seguridad laravel -->
        <div class="col-sm-12">
            <div class="panel panel-default">
                <br>
                <div class="panel-body">
                    <div class="col-sm-12 text-center">
                        <div class="form-group label-floating">
                            <label class="custom-file-upload mr-3">
                                <input type="file" size="200" name="imagen" id="imagen" onchange="loadFile(event)" accept="image/x-png,image/gif,image/jpeg" required>
                                Seleccionar imagen
                            </label><br><br>
                            Vista previa: <br>
                            <img src="/images/app/notfound.png" alt="preview" width="300" id="output"/>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <br>
        <div class="col-sm-12 text-right">
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-raised btn-sm">Cancelar</a>
            <button type="submit" class="btn btn-primary btn-raised btn-sm">Agregar</button>
        </div>
        <br>
    </form>
</div>
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