@extends('layout.layout')
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
                  <th scope="col">Nombre<button id="1" class="btn btn-sm sort" onclick="sortTable(1)">^</button></th>
                  <th scope="col">Área<button id="2" class="btn btn-sm sort" onclick="sortTable(2)">^</button></th>
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
              <td class="area" scope="row">{{ $solicitud->area->nombre }}</td>
              <td scope="row"><img class="myImg" id="myImg{{$solicitud->url_acta}}" src="/images/{{$solicitud->url_acta}}" width="50" alt=""></td>
              <td scope="row"><img class="myImg" id="myImg{{$solicitud->url_comprobante}}" src="/images/{{$solicitud->url_comprobante}}" width="50" alt=""></td>
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
            <button class="btn btn-warning check" data-id="{{ $solicitud->id }}">Comprobar usuario</button>
            <p id="status{{$solicitud->id}}"></p>
      </div>
      <div class="modal-footer">
        <!-- <form action="" method="POST"> -->
            <!-- @csrf -->
            <button type="button" class="btn btn-default btn-raised" data-dismiss="modal">Cancelar</button>
            <button type="sumbmit" class="btn btn-success btn-raised accept" data-id="{{ $solicitud->id }}">Aceptar</button>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>
<!-- Script para visualizar las imagenes en solicitudes -->
<script>
  var modal = document.getElementById("myModal");
  var img1 = document.getElementById("myImg{{$solicitud->url_acta}}");
  var img2 = document.getElementById("myImg{{$solicitud->url_comprobante}}");
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  img1.onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
  img2.onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
  var span = document.getElementsByClassName("close")[0];
  span.onclick = function() {
    modal.style.display = "none";
  }
</script>
@endforeach
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log("JS Active")
    btnAccept();
    btnCheck();
});
  function btnAccept() {
      var token = '{{ csrf_token() }}';
      document.querySelectorAll('.accept').forEach(btn => {
          btn.onclick = function () {
            let message = document.getElementById("status"+btn.dataset.id);
            if(message.innerHTML == "" || message.innerHTML == "Usuario no disponible"){
              message.innerHTML = "Verifica que el usuario este disponible";
            } else {
              let usr = document.getElementById("field"+btn.dataset.id);
               fetch('/admin/usuarios/solicitudes/aceptar', {
                  headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": token
                  },
                  method: 'post',
                  body: JSON.stringify({
                    solicitud_id: btn.dataset.id,
                    username: usr.value
                    })
               })
               .then(response => response.json())
               .then(result => {
                if (result.error) {
                    console.log(`Error at like: ${result.error}`);
                }
                 console.log(result[0])
                 
                 modal = document.getElementById('modalAccept'+btn.dataset.id);
                 modal.innerHTML = `
                 <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                      <h5 class="modal-title">Solicitud aceptada</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                          <h4>Notifica al usuario que ha sido registrado mediante sus datos de contacto</h4><br>
                          <h5><b>Nombre:</b> ${result[0].nombre} ${result[0].apellido_paterno} ${result[0].apellido_materno}</h5>
                          <h5><b>Sección:</b> ${result[1].nombre}</h5>
                          <h5><b>Usuario:</b> ${result[0].usuario}</h5>
                          <h5><b>Contraseña:</b> ${result[0].contraseña}</h5>
                          <h5><b>Telefono:</b> ${result[0].telefono}</h5>
                          <h5><b>Correo:</b> ${result[0].email}</h5>
                    </div>
                    <div class="modal-footer">
                          <!-- @csrf -->
                          <button type="button" class="btn btn-default btn-raised" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>`;
                document.getElementById("id"+btn.dataset.id).remove();
               });
            }
          }
      });   
  }
  function btnCheck() {
    var token = '{{ csrf_token() }}';
      document.querySelectorAll('.check').forEach(btn => {
          btn.onclick = function () {
            let usr = document.getElementById("field"+btn.dataset.id);
               fetch('/admin/usuarios/solicitudes/check', {
                  headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": token
                  },
                  method: 'post',
                  body: JSON.stringify({
                    username: usr.value,
                    })
               })
               .then(response => response.json())
               .then(result => {
                  let message = document.getElementById("status"+btn.dataset.id);
                  message.removeAttribute('class');
                  if(result.status == "error") {
                    message.classList.add("text-danger");
                  } else {
                    message.classList.add("text-success");
                  }
                  message.innerHTML = `${result.message}`;
               });
          }
      });   
  }
</script>
@endsection