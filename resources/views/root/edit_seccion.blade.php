@extends('layout.layout2')
@section('titulo') Panel Super-Usuario @endsection
@section('section')
@include('root.navigation')

<div class="container text-center card">
    <h1>Editar nombre de la sede</h1>

    <form action="{{ route ('seccion.update') }}" method="post">
        @csrf <!-- Seguridad laravel -->
        <div class="col-sm-12">
            <div class="panel panel-default">
            <br>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="form-group label-floating text-center">
                            <label class="control-label">Nombre anterior</label>
                            <h4>{{ $seccion->nombre }}</h4>
                        </div>
                        <hr>
                        <div class="form-group label-floating">
                            <label for="no_de_control" class="control-label">Nuevo nombre</label>
                            <input type="hidden" class="form-control" name="id" id="id" value="{{ $seccion->id }}">
                            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $seccion->nombre }}">
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