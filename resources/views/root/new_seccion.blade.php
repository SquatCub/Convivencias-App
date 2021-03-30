@extends('layout.layout')
@section('titulo') Panel Super-Usuario @endsection
@section('section')
@include('root.navigation')

<div class="container text-center card">
    <h1>Crear nueva sección</h1>

    <form action="{{ route ('seccion.create') }}" method="post">
        @csrf <!-- Seguridad laravel -->
        <div class="col-sm-12">
            <div class="panel panel-default">
            <br>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label for="no_de_control" class="control-label">Nombre de la seccion</label>
                            <input type="text" class="form-control" name="nombre" id="nombre_aula">
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <br>
        <div class="col-sm-12 text-right">
            <button type="submit" class="btn btn-primary btn-raised btn-sm">Guardar</button>
        </div>
        <br>
    </form>
</div>
@endsection