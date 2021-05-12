@extends('layout.layout2')
@section('titulo') Editar actividad @endsection
@section('section')
@include('admin.navigation')

<div class="container text-center card">
    <h1>Editar actividad</h1>

    <form action="{{ route ('actividad.update') }}" method="post" enctype="multipart/form-data">
        @csrf <!-- Seguridad laravel -->
        <div class="col-sm-12">
            <div class="panel panel-default">
                <br>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label for="no_de_control" class="control-label">Nombre de la actividad</label>
                            <input type="hidden" class="form-control text-center" name="id_actividad" id="id_actividad" value="{{$actividad->id}}">
                            <input type="text" class="form-control text-center" name="nombre" id="nombre_actividad" value="{{$actividad->nombre}}">
                        </div>
                        <div class="form-group label-floating">
                            <label for="no_de_control" class="control-label">Categoría</label>
                            <select class="form-control" name="id_categoria" required>
                                <option value="{{$actividad->categoria->id}}" selected>{{$actividad->categoria->nombre}}</option>
                                @foreach($categorias as $categoria)
                                @if($categoria->id!=$actividad->categoria->id)
                                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endif
                                @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label for="no_de_control" class="control-label">Descripción</label>
                            <textarea type="text" rows="2" class="form-control" name="descripcion">{{$actividad->descripcion}}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label for="no_de_control" class="control-label">Enlace del video (YouTube)</label>
                            <input type="text" class="form-control" name="url" value="https://youtu.be/{{$actividad->video_url}}"> 
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <div class="form-group label-floating">
                            <label class="custom-file-upload mr-3">
                                <input type="file" size="200" name="imagen" id="imagen" onchange="loadFile(event)" accept="image/x-png,image/gif,image/jpeg">
                                Seleccionar imagen
                            </label>
                            <img src="/images/{{$actividad->imagen}}" alt="preview" width="70" id="output"/>
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
@endsection