@extends('layout.layout2')
@section('titulo') Editar categoría @endsection
@section('section')
@include('admin.navigation')

<div class="container text-center card">
    <h1>Editar categoría</h1>

    <form action="{{ route ('categoria.update') }}" method="post" enctype="multipart/form-data">
        @csrf <!-- Seguridad laravel -->
        <div class="col-sm-12">
            <div class="panel panel-default">
                <br>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label for="no_de_control" class="control-label">Nombre de la categoría</label>
                            <input type="hidden" class="form-control text-center" name="id" id="id_categoría" value="{{$categoria->id}}">
                            <input type="text" class="form-control text-center" name="nombre" id="nombre_categoría" value="{{$categoria->nombre}}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label for="no_de_control" class="control-label">Descripción</label>
                            <textarea type="text" rows="2" class="form-control" name="descripcion">{{$categoria->descripcion}}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label for="no_de_control" class="control-label">Estado</label>
                            <select class="form-control" name="estado" required>
                                <option @if($categoria->estado == 0) selected @endif value="0">Desactivado</option>
                                <option @if($categoria->estado == 1) selected @endif value="1">Activado</option>
                            </select> 
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <div class="form-group label-floating">
                            <label class="custom-file-upload mr-3">
                                <input type="file" size="200" name="imagen" id="imagen" onchange="loadFile(event)" accept="image/x-png,image/gif,image/jpeg" value="">
                                Seleccionar imagen
                            </label>
                            <img src="/images/{{$categoria->imagen}}" alt="preview" width="70" id="output"/>
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