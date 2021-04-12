document.addEventListener('DOMContentLoaded', function() {
    console.log("JS Active")
    btnAccept();
    btnCheck();
});

  function btnAccept() {
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
                    "X-CSRF-Token": btn.dataset.token
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
      document.querySelectorAll('.check').forEach(btn => {
          btn.onclick = function () {
            let usr = document.getElementById("field"+btn.dataset.id);
               fetch('/admin/usuarios/solicitudes/check', {
                  headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": btn.dataset.token
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