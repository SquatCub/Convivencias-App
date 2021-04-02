@extends('layout.layout')
@section('titulo') Panel Super-Usuario @endsection
@section('section')
@include('root.navigation')

<div class="container text-center card">
    <h1>Crear nueva sección</h1>

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
                            <label for="no_de_control" class="control-label">Imagen</label><br>
                            <input type="file" name="imagen" id="imagen" accept="image/x-png,image/gif,image/jpeg">
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