@extends('layout.layout')
@section('titulo') Convivencias - Inicia sesión o registrate @endsection
@section('section')
<div class="container">
    <!-- Login -->
    @if($opcion == 'iniciar')
    @section('navigation')
        @include('layout.navigation')
    @endsection
    <form class="text-center" action="{{ route('log') }}" method="POST">
        {{ csrf_field() }}
        <h1>Inicia sesión</h1>
        <h5>Ingresa a la pagina si ya cuentas con tu usuario y contraseña, si no es así puedes registrarte en la sección de registro</h5> 
        <br>
        <div class="form-group">
            <div class="form-group col-md-6 container">
                <label for="usuario">Nombre de usuario</label> 
                <input type="text" name="usuario" id="usuario" class="form-control">
                <div class="{{ $errors->has('usuario') ? 'has-error' : '' }}"> 
                    {!! $errors->first('usuario', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group col-md-6 container">
                <label for="password">Contraseña</label> 
                <input type="password" name="password" id="password" class="form-control">
                <div class="{{ $errors->has('password') ? 'has-error' : '' }}"> 
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <button class="btn btn-success btn-lg" type="submit"> Acceder</button>
        <br><br>
    </form>

    <!-- Registro -->
    @elseif($opcion == 'registro')
    @section('navigation')
        @include('layout.navigation')
    @endsection
    <form class="text-center" action="{{ route('enviar') }}" method="POST" enctype="multipart/form-data"  onsubmit="myButton.disabled = true; return true;">
        @csrf
        <h1>Envia solicitud para registrarte</h1>
        <h5>Ingresa tus datos para poder registrarte en el sistema, debes ingresar tus datos correctamente y adjuntar los archivos para validar tu información. Una vez que mandes la solicitud y se apruebe, se te contactará y podrás iniciar sesión para usar la página</h5> 
        <br>
        <h4>Datos personales</h4>
        <div class="row">
            <div class="col-md-4 col-sm-12">
            <label for="Nombre" class="control-label">Nombre(s)</label>
            <input class="form-control" autofocus type="text" name="name" placeholder="Nombre(s)" required>
            </div>
            <div class="col-md-4 col-sm-12">
            <label for="paterno" class="control-label">Apellido paterno</label>
            <input class="form-control" autofocus type="text" name="paterno" placeholder="Apellido paterno" required>
            </div>
            <div class="col-md-4 col-sm-12">
            <label for="materno" class="control-label">Apellido materno</label>
            <input class="form-control" autofocus type="text" name="materno" placeholder="Apellido materno">
            </div>
        </div>
        <br>

        <div class="form-row">
            <div class="form-group col-md-4">
            <label for="edad" class="control-label">Edad</label>
            <input class="form-control" autofocus type="number" name="edad" placeholder="Edad" required>
            </div>
            <div class="form-group col-md-4">
            <label for="sexo" class="control-label">Sexo</label>
            <select id="sede" class="form-control" name="sexo" required>
                <option value="" disabled="disabled" selected></option>
                <option value="F">Femenino</option>
                <option value="M">Masculino</option>
            </select>
            </div>
            <div class="form-group col-md-4">
            <label for="centro" class="control-label">Centro de trabajo</label>
            <input class="form-control" autofocus type="text" name="centro" placeholder="Ej. IMMS, Centro de salud, etc" required>
            </div>
        </div>

        <div class="form-group">
            <label for="no_de_control" class="control-label">Sede</label>
            <select class="form-control container col-md-3 col-sm-12" name="id_seccion" required>
                <option value="" disabled="disabled" selected></option>
                @foreach($secciones as $seccion)
                <option value="{{$seccion->id}}">{{$seccion->nombre}}</option>
                @endforeach
            </select> 
        </div>
        
        <hr>
        <h4>Datos de usuario (Con esto podrás iniciar sesión)</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputUsuario">Nombre de usuario</label>
                <input id="inputUsuario" class="form-control" required autofocus type="text" name="username" placeholder="Nombre de usuario (Ej. Juan123)">
            </div>
            <div class="form-group col-md-6">
                <label for="inputContrasena">Contraseña</label>
                <input id="inputContrasena" class="form-control" required type="password" name="password" placeholder="Contraseña">
            </div>
        </div>
        <hr>
        <h4>Datos de contacto (Por este medio se te enviará tu Confirmación)</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputPhone">Numero de celular</label>
                <input id="inputPhone" class="form-control" required type="phone" name="phone" placeholder="Número de celular (obligatorio)">
            </div>
            <div class="form-group col-md-6">
                <label for="inputMail">Correo electrónico</label>
                <input id="inputMail" class="form-control" type="email" name="email" placeholder="Correo electrónico">
            </div>
        </div>
        <div class="text-center">
            <hr>
            <h4>Documentos: sirven para validar tu información</h4>
            <h5>Formatos de imagen soportados: PNG, GIF, JPEG</h5>
            <br>
            <h5>Acta de nacimiento</h5>
            <div class="form-group">
                <label class="custom-file-upload mr-3">
                    <input required type="file" size="200" name="acta" id="acta" onchange="loadFile1(event)" accept="image/x-png,image/gif,image/jpeg">
                        Seleccionar acta
                </label>
                <img src="/images/app/notfound.png" alt="preview" width="70" id="output1"/>
            </div>
            <h5>Comprobante de pago</h5>
            <div class="form-group">
                <label class="custom-file-upload mr-3">
                    <input required type="file" size="200" name="comprobante" id="comprobante" onchange="loadFile2(event)" accept="image/x-png,image/gif,image/jpeg">
                        Seleccionar comprobante
                </label>
                <img src="/images/app/notfound.png" alt="preview" width="70" id="output2"/>
            </div>
            <br>
            <button class="btn btn-success btn-lg" id="submitbutton" name="myButton" type="submit">Enviar solicitud</button>
            <br><br>
        </div>
    </form>
    <script>
    var loadFile1 = function(event) {
        var output = document.getElementById('output1');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };
    var loadFile2 = function(event) {
        var output = document.getElementById('output2');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };
    </script>
    @endif
</div>
@endsection