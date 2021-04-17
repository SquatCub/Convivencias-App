@extends('layout.layout2')
@section('titulo') Panel Super-Usuario @endsection
@section('section')
@include('root.navigation')
<div class="container card">
<br>
    <h1>Administradores</h1>
    <div class="text-right">
        <a href="{{ route ('admin.new') }}" class="btn btn-success">Crear nuevo administrador</a>
    </div>
    <br>

    <div class="table-responsive">
      <table id="myTable" class="table table-hover text-center">
          <thead class="thead-dark">
              <tr>
                  <th scope="col">#  <button id="0" class="btn btn-sm sort" onclick="sortTable(0)">^</button></th>
                  <th scope="col">Nombre completo  <button id="1" class="btn btn-sm sort" onclick="sortTable(1)">^</button></th>
                  <th scope="col">Usuario  <button id="2" class="btn btn-sm sort" onclick="sortTable(2)">^</button></th>
                  <th scope="col">Área  <button id="3" class="btn btn-sm sort" onclick="sortTable(3)">^</button></th>
                  <th scope="col">Acciones</th>
              </tr>
          </thead>
          <tbody id="id01">
              @foreach($admins as $admin)
              <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td scope="row">{{ $admin->nombre }} {{ $admin->apellido_paterno }} {{ $admin->apellido_materno }}</td>
              <td scope="row">{{ $admin->user->usuario }}</td>
              <td class="area" scope="row">{{ $admin->area->nombre }}</td>
              <td scope="row"><a href="{{ route ('admin.editar', $admin) }}" class="btn btn-primary btn-sm">Editar</a> <a class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#modalDelete{{ $admin->user->id }}">Eliminar</a></td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </div>
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