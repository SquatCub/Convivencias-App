@extends('layout.layout')
@section('titulo') Panel Super-Usuario @endsection
@section('section')
@include('root.navigation')

@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<div class="container card">
<strong>Correcto</strong>  {{ session()->get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
</div>
@endif

<div class="container card">
<br>
    <h1>Administradores</h1>
    <div class="text-right">
        <a href="{{ route ('admin.new') }}" class="btn btn-warning">Crear nuevo administrador</a>
    </div>
    <br>

    <table class="table table-hover text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre completo</th>
                <th scope="col">Usuario</th>
                <th scope="col">Área</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
            <tr>
            <td scope="row">{{ $loop->iteration }}</td>
            <td scope="row">{{ $admin->nombre }} {{ $admin->apellido_paterno }} {{ $admin->apellido_materno }}</td>
            <td scope="row">{{ $admin->user->usuario }}</td>
            <td scope="row">{{ $admin->area->nombre }}</td>
            <td scope="row"><a href="" class="btn btn-primary btn-sm">Editar</a> <a class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#modalDelete{{ $admin->user->id }}">Eliminar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@foreach ($admins as $admin)
<div class="modal fade" id="modalDelete{{ $admin->user->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirmación de eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <h4>¿Está seguro de querer eliminar el administrador?</h4><br>
            <h5><b>Nombre:</b> {{ $admin->nombre }} {{ $admin->apellido_paterno }} {{ $admin->apellido_materno }}</h5>
            <h5><b>Área:</b> {{ $admin->area->nombre }}</h5>
      </div>
      <div class="modal-footer">
        <form action="{{ route('admin.eliminar', $admin->user->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="button" class="btn btn-default btn-raised" data-dismiss="modal">Cancelar</button>
            <button type="sumbmit" class="btn btn-warning btn-raised" id="cursos-confirm-delete">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endforeach

@endsection