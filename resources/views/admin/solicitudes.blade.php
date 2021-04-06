@extends('layout.layout')
@section('titulo') Panel Super-solicitud @endsection
@section('section')
@include('admin.navigation')
<div class="container card">
<br>
    <h1>Usuarios -> Solicitudes</h1>
    <div class="text-right">
        <a href="{{ route ('admin.usuarios') }}" class="btn btn-light">Regresar</a>
    </div>
    <br>

    <div class="table-responsive">
      <table id="myTable" class="table table-hover text-center">
          <thead class="thead-dark">
              <tr>
                  <th scope="col">#<button id="0" class="btn btn-sm sort" onclick="sortTable(0)">^</button></th>
                  <th scope="col">Nombre<button id="1" class="btn btn-sm sort" onclick="sortTable(1)">^</button></th>
                  <th scope="col">Área<button id="2" class="btn btn-sm sort" onclick="sortTable(2)">^</button></th>
                  <th scope="col">Acta</th>
                  <th scope="col">Comprobante </th>
                  <th scope="col">Acciones </th>
              </tr>
          </thead>
          <tbody id="id01">
              @foreach($solicitudes as $solicitud)
              <tr>
              <td scope="row">{{ $loop->iteration }}</td>
              <td scope="row">{{ $solicitud->nombre }} {{ $solicitud->apellido_paterno }} {{ $solicitud->apellido_materno }}</td>
              <td class="area" scope="row">{{ $solicitud->area->nombre }}</td>
              <td scope="row"><img class="myImg" id="myImg{{$solicitud->url_acta}}" src="/images/{{$solicitud->url_acta}}" width="50" alt=""></td>
              <td scope="row"><img class="myImg" id="myImg{{$solicitud->url_comprobante}}" src="/images/{{$solicitud->url_comprobante}}" width="50" alt=""></td>
              <td scope="row"><a href="{{ route ('admin.editar', $solicitud) }}" class="btn btn-primary btn-sm">Aceptar</a> <a class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#modalDelete{{ $solicitud->id }}">Eliminar</a></td>
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
<div class="modal fade" id="modalDelete{{ $solicitud->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirmación de eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <h4>¿Está seguro de querer eliminar el solicitudistrador?</h4><br>
            <h5><b>Nombre:</b> {{ $solicitud->nombre }} {{ $solicitud->apellido_paterno }} {{ $solicitud->apellido_materno }}</h5>
            <h5><b>Área:</b> {{ $solicitud->area->nombre }}</h5>
      </div>
      <div class="modal-footer">
        <form action="{{ route('admin.eliminar', $solicitud->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="button" class="btn btn-default btn-raised" data-dismiss="modal">Cancelar</button>
            <button type="sumbmit" class="btn btn-warning btn-raised" id="cursos-confirm-delete">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  // Get the modal
  var modal = document.getElementById("myModal");
  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img1 = document.getElementById("myImg{{$solicitud->url_acta}}");
  var img2 = document.getElementById("myImg{{$solicitud->url_comprobante}}");
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  img1.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
  img2.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
</script>
@endforeach

@endsection