@extends('layout.layout')
@section('titulo') Panel Super-Usuario @endsection
@section('section')
@include('root.navigation')
<div class="container text-center card">
    <br>
    <h1>Editar datos del administrador</h1>
    <br>
    <form action="{{ route ('admin.update') }}" method="post">
        @csrf <!-- Seguridad laravel -->
        
        <div class="row">
            <div class="col">
                <span>Nombre(s)</span>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" value="{{ $admin->nombre }}" required>
            </div>
            <div class="col">
                <span>Apellido paterno</span>
                <input type="text" class="form-control" name="paterno" placeholder="Apellido Paterno" value="{{ $admin->apellido_paterno }}" required>
            </div>
            <div class="col">
                <span>Apellido materno</span>
                <input type="text" class="form-control" name="materno" placeholder="Apellido Materno" value="{{ $admin->apellido_materno }}">
            </div>
        </div>
        <br>
        <div class="row text-left">
            <div class="col-md-1 col-sm-6">
                <label for="password">Usuario: </label>
            </div>
            <div class="col-md-2 col-sm-6">
                <input type="hidden" class="form-control" name="id_usuario" value="{{ $admin->user->id }}" required>
                <input type="hidden" class="form-control" name="id_admin" value="{{ $admin->id }}" required>
                <input type="text" class="form-control" name="username" placeholder="Nombre de usuario" value="{{ $admin->user->usuario }}" required>
                <small id="passwordHelpBlock" class="form-text text-muted">
                    Ej. Juanito321
                </small>
            </div>
        </div>
        <br>
        <div class="row text-left">
            <div class="col-md-1 col-sm-6">
                <label for="password">Nueva contraseña: </label>
            </div>
            <div class="col-md-2 col-sm-6">
                <input type="text" class="form-control" name="password" placeholder="Contraseña" value="" required>
                <small id="passwordHelpBlock" class="form-text text-muted">
                    Usar una contraseña segura
                </small>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-1">
                <label for="password">Area: </label>
            </div>
            <div class="col-3">
                <select class="form-control" name="id_area" required>
                    <option value="{{$admin->area->id}}">{{$admin->area->nombre}}</option>
                    @foreach($areas as $area)
                    @if($area->id != $admin->area->id)
                    <option value="{{$area->id}}">{{$area->nombre}}</option>
                    @endif
                    
                    @endforeach
                </select> 
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