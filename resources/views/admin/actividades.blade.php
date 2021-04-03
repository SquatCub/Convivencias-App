@extends('layout.layout')
@section('titulo') Panel Administrador - Actividades @endsection
@section('section')
@include('admin.navigation')
<div class="container card">
    <br>
    <h1>Actividades</h1>
    <div class="text-right">
        <a href="{{ route ('actividad.new') }}" class="btn btn-success text-white">Añadir nueva actividad</a>
    </div>
    <br>
    <div class="container table-responsive">
        <table id="myTable" class="table table-hover text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"># <button id="0" class="btn btn-sm sort" onclick="sortTable(0)">^</button></th>
                    <th scope="col">Nombre <button id="1" class="btn btn-sm sort" onclick="sortTable(1)">^</button></th>
                    <th scope="col">Categoría <button id="2" class="btn btn-sm sort" onclick="sortTable(2)">^</button></th>
                    <th scope="col">Descripción <button id="3" class="btn btn-sm sort" onclick="sortTable(3)">^</button></th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($actividades as $actividad)
                <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td scope="row">{{ $actividad->nombre }}</td>
                <td scope="row">{{ $actividad->categoria->nombre }}</td>
                <td class="desc" scope="row">{{ $actividad->descripcion }}</td>
                <td scope="row"><img src="/images/{{$actividad->imagen}}" width="50" alt=""></td>
                <td scope="row"><a href="{{ route ('seccion.editar', $actividad) }}" class="btn btn-primary btn-sm">Editar</a> <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete{{ $actividad->id }}">Eliminar</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@foreach ($actividades as $actividad)
<div class="modal fade" id="modalDelete{{ $actividad->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirmación de eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <h4>¿Está seguro de querer eliminar la actividad?</h4><br>
            <h5><b>Nombre:</b> {{ $actividad->nombre }}</h5>
            <hr>
            <b>Esta acción no se podrá deshacer.</b>
            <b>Se eliminarán todas las imagenes que se compartieron en esta actividad.</b>
      </div>
      <div class="modal-footer">
        <form action="{{ route('actividad.eliminar', $actividad) }}" method="POST">
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
<script>
    desc = document.querySelectorAll('.desc');
    desc.forEach(element=> {
        var aux = "";
        var s = element.innerHTML;
        var i = 0;
        if (s.length < 30) {
            aux+=s;
        } else {
            for (i = 0; i < 30; i++) {
                aux+= s[i];
            }
        }
        aux += '...';
        element.innerHTML = aux;
    });
</script>
@endsection