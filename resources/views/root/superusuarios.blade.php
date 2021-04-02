@extends('layout.layout')
@section('titulo') Panel Super-Usuario @endsection
@section('section')
@include('root.navigation')
<div class="container card">
<br>
    <h1>Superusuarios</h1>
    <div class="text-right">
        <a href="{{ route ('root.new') }}" class="btn btn-success">Crear nuevo superusuario</a>
    </div>
    <br>
    <div class="table-responsive">
      <table id="myTable" class="table table-hover text-center">
          <thead class="thead-dark">
              <tr>
                  <th scope="col"># <button id="0" class="btn btn-sm sort" onclick="sortTable(0)">^</button></th>
                  <th scope="col">Nombre completo <button id="1" class="btn btn-sm sort" onclick="sortTable(1)">^</button></th>
                  <th scope="col">Usuario <button id="2" class="btn btn-sm sort" onclick="sortTable(2)">^</button></th>
                  <th scope="col">Acciones</th>
              </tr>
          </thead>
          <tbody>
              @foreach($roots as $root)
              <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td scope="row">{{ $root->nombre }} {{ $root->apellido_paterno }} {{ $root->apellido_materno }}</td>
              <td scope="row">{{ $root->user->usuario }}</td>
              <td scope="row"><a href="{{ route ('root.editar', $root) }}" class="btn btn-primary btn-sm">Editar</a>
              @if(Auth::user()->root->id_usuario != $root->id_usuario) 
              <a class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#modalDelete{{ $root->user->id }}">Eliminar</a>
              @endif
              </td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </div>
</div>

@foreach ($roots as $root)
<div class="modal fade" id="modalDelete{{ $root->user->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirmación de eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <h4>¿Está seguro de querer eliminar el rootistrador?</h4><br>
            <h5><b>Nombre:</b> {{ $root->nombre }} {{ $root->apellido_paterno }} {{ $root->apellido_materno }}</h5>
      </div>
      <div class="modal-footer">
        <form action="{{ route('root.eliminar', $root->user->id) }}" method="POST">
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