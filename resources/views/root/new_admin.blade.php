@extends('layout.layout')
@section('titulo') Panel Super-Usuario @endsection
@section('section')
@include('root.navigation')
<div class="container text-center card">
    <br>
    <h1>Crear nuevo administrador</h1>
    <br>

    <form action="{{ route ('admin.create') }}" method="post">
        @csrf <!-- Seguridad laravel -->
        
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" required>
            </div>
            <div class="col">
                <input type="text" class="form-control" name="paterno" placeholder="Apellido Paterno" required>
            </div>
            <div class="col">
                <input type="text" class="form-control" name="materno" placeholder="Apellido Materno">
            </div>
        </div>
        <br>
        <div class="row text-left">
            <div class="col-1">
                <label for="password">Usuario: </label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control" name="username" placeholder="Nombre de usuario" required>
            </div>
        </div>
        <br>
        <div class="row text-left">
            <div class="col-1">
                <label for="password">Contraseña: </label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control" name="password" placeholder="Contraseña" required>
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
                    <option value="" disabled="disabled" selected></option>
                    @foreach($areas as $area)
                    <option value="{{$area->id}}">{{$area->nombre}}</option>
                    @endforeach
                </select> 
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