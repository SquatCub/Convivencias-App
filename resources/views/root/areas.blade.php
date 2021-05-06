@extends('layout.layout2')
@section('titulo') Panel Super-Usuario @endsection
@section('section')
@include('root.navigation')
<div class="container card">
    <br>
    <h1>Secciones</h1>
    <div class="text-right">
        <a href="{{ route ('seccion.new') }}" class="btn btn-success text-white">Añadir nueva sede</a>
    </div>
    <br>
    <div class="container table-responsive">
        <table id="myTable" class="table table-hover text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"># <button id="0" class="btn btn-sm sort" onclick="sortTable(0)">^</button></th>
                    <th scope="col">Nombre <button id="1" class="btn btn-sm sort" onclick="sortTable(1)">^</button></th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($areas as $area)
                <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td scope="row">{{ $area->nombre }}</td>
                <td scope="row"><a href="{{ route ('seccion.editar', $area) }}" class="btn btn-primary btn-sm">Editar</a> <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete{{ $area->id }}">Eliminar</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach ($areas as $area)
<div class="modal fade" id="modalDelete{{ $area->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirmación de eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <h4>¿Está seguro de querer eliminar la sede?</h4><br>
            <h5><b>Nombre:</b> {{ $area->nombre }}</h5>
            <hr>
            <b>Esta acción no se podrá deshacer.</b>
            <b>No podrás eliminar sedes que estén asignadas a otros usuarios.</b>
      </div>
      <div class="modal-footer">
        <form action="{{ route('seccion.eliminar', $area) }}" method="POST">
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