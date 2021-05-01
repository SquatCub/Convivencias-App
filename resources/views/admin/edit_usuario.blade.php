@extends('layout.layout2')
@section('titulo') Crear nuevo usuario @endsection
@section('section')
@include('admin.navigation')
<div class="container text-center card">
    <br>
    <h1>Crear nuevo usuario</h1>
    <br>
    <form action="{{ route ('usuario.update') }}" method="post">
        @csrf <!-- Seguridad laravel -->
        <div class="row text-left">
            <div class="col-md-4 col-sm-6">
                <span>Nombre(s)</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" value="{{$usuario->nombre}}" required>
            </div>
            <div class="col-md-4 col-sm-6">
                <span>Apellido paterno</span>
                <input type="text" class="form-control" name="paterno" placeholder="Apellido Paterno" value="{{$usuario->apellido_paterno}}" required>
            </div>
            <div class="col-md-4 col-sm-6">
                <span>Apellido materno</span>
                <input type="text" class="form-control" name="materno" placeholder="Apellido Materno" value="{{$usuario->apellido_materno}}">
            </div>
        </div>
        <br>
        <div class="row text-left">
            <div class="col-lg-1 col-md-1 col-sm-2">
                <label for="password">Usuario: </label>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <input type="text" class="form-control" name="username" id="fieldUser" placeholder="Nombre de usuario" required value="{{$usuario->user->usuario}}">
                <p id="statusUser"></p>
                <button type="button" class="btn btn-warning check" data-id="User" data-token="{{ csrf_token() }}">Comprobar usuario</button>
                <small id="passwordHelpBlock" class="form-text text-muted">
                    Ej. Juanito321
                </small>
            </div>
        </div>
        <br>
        <div class="row text-left">
            <div class="col-lg-1 col-md-2 col-sm-2">
                <label for="password">Contraseña: </label>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <input type="text" class="form-control" name="password" placeholder="Contraseña" required>
                <small id="passwordHelpBlock" class="form-text text-muted">
                    Usar una contraseña segura
                </small>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-1 col-sm-1">
                <label for="password">Area: </label>
            </div>
            <div class="col-md-2 col-sm-6">
                <select class="form-control" name="id_area" required>
                    
                    @foreach($areas as $area)
                    @if($area == $usuario->area)
                    <option selected value="{{$usuario->area->id}}">{{$usuario->area->nombre}}</option>
                    @else
                    <option value="{{$area->id}}">{{$area->nombre}}</option>
                    @endif
                    @endforeach
                </select> 
            </div>
        </div>
        <br>
        <div class="col-sm-12 text-right">
            <input type="hidden" class="form-control" name="id_user" value="{{ $usuario->user->id }}" required>
            <input type="hidden" class="form-control" name="id_usuario" value="{{ $usuario->id }}" required>
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-raised btn-sm">Cancelar</a>
            <button type="submit" class="btn btn-primary btn-raised btn-sm">Guardar</button>
        </div>
        <br>
    </form>
</div>
@endsection