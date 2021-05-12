@extends('layout.layout2')
@section('titulo') Panel Administrador - Solicitudes @endsection
@section('section')
@include('admin.navigation')
<div class="container card">
<br>
    <h1>Solicitudes pendientes</h1>
    <div class="text-right">
        <a href="{{ route ('admin.usuarios') }}" class="btn btn-light">Regresar</a>
    </div>
    <br>
    <div class="table-responsive">
      <table id="myTable" class="table table-hover text-center">
          <thead class="thead-dark">
              <tr>
                  <th scope="col">#<button id="0" class="btn btn-sm sort" onclick="sortTable(0)">^</button></th>
                  <th scope="col">Nombre <button id="1" class="btn btn-sm sort" onclick="sortTable(1)">^</button></th>
                  <th scope="col">Sede <button id="2" class="btn btn-sm sort" onclick="sortTable(2)">^</button></th>
                  <th scope="col">Sexo <button id="3" class="btn btn-sm sort" onclick="sortTable(3)">^</button></th>
                  <th scope="col">Edad <button id="4" class="btn btn-sm sort" onclick="sortTable(4)">^</button></th>
                  <th scope="col">Acta</th>
                  <th scope="col">Comprobante </th>
                  <th scope="col">Acciones </th>
              </tr>
          </thead>
          <tbody id="id01">
              @foreach($solicitudes as $solicitud)
              <tr id="id{{ $solicitud->id }}">
              <td scope="row">{{ $loop->iteration }}</td>
              <td scope="row">{{ $solicitud->nombre }} {{ $solicitud->apellido_paterno }} {{ $solicitud->apellido_materno }}</td>
              <td scope="row">{{ $solicitud->area->nombre }}</td>
              <td scope="row">{{ $solicitud->sexo }}</td>
              <td scope="row">{{ $solicitud->edad }}</td>
              <td scope="row"><img class="myImg" onclick="showImage(this)" id="myImg{{$solicitud->url_acta}}" src="/images/{{$solicitud->url_acta}}" width="50" alt=""></td>
              <td scope="row"><img class="myImg" onclick="showImage(this)" id="myImg{{$solicitud->url_comprobante}}" src="/images/{{$solicitud->url_comprobante}}" width="50" alt=""></td>
              <td scope="row"><a class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#modalAccept{{ $solicitud->id }}">Aceptar</a> <a class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#modalDelete{{ $solicitud->id }}">Rechazar</a></td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </div>
</div>
<!-- The Modal -->
<div id="myModal" class="modal-img">
  <!-- The Close Button -->
  <span class="close">&times;</span>
  <!-- Modal Content (The Image) -->
  <img class="modal-img-content" id="img01">
  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
@foreach ($solicitudes as $solicitud)
<!-- Modals para eliminacion -->
<div class="modal fade" id="modalDelete{{ $solicitud->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirmación de rechazo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <h4>¿Está seguro de querer eliminar la solicitud?</h4><br>
            <h5><b>Nombre:</b> {{ $solicitud->nombre }} {{ $solicitud->apellido_paterno }} {{ $solicitud->apellido_materno }}</h5>
            <h5><b>Área:</b> {{ $solicitud->area->nombre }}</h5>
      </div>
      <div class="modal-footer">
        <form action="{{ route('solicitud.eliminar', $solicitud->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="button" class="btn btn-default btn-raised" data-dismiss="modal">Cancelar</button>
            <button type="sumbmit" class="btn btn-warning btn-raised" id="cursos-confirm-delete">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modals para pre-aceptar -->
<div class="modal fade" id="modalAccept{{ $solicitud->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Confirmación de solicitud</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <h4>¿Aceptar usuario?</h4><br>
            <p>Por favor verifica que todos sus datos sean correctos, revisa los documentos anexados</p>
            <h5><b>Nombre:</b> {{ $solicitud->nombre }} {{ $solicitud->apellido_paterno }} {{ $solicitud->apellido_materno }}</h5>
            <h5><b>Área:</b> {{ $solicitud->area->nombre }}</h5>
            <h6>Usuario: <input type="text" id="field{{ $solicitud->id }}" value="{{ $solicitud->usuario }}"></h6> 
            <h6>Contraseña: {{ $solicitud->contraseña }}</h6>
            <hr>
            <button class="btn btn-warning check" data-id="{{ $solicitud->id }}" data-token="{{ csrf_token() }}">Comprobar usuario</button>
            <p id="status{{$solicitud->id}}"></p>
      </div>
      <div class="modal-footer">
        <!-- <form action="" method="POST"> -->
            <!-- @csrf -->
            <button type="button" class="btn btn-default btn-raised" data-dismiss="modal">Cancelar</button>
            <button type="sumbmit" class="btn btn-success btn-raised accept" data-id="{{ $solicitud->id }}" data-token="{{ csrf_token() }}">Aceptar</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection