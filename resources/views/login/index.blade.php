@extends('layout.layout')
@section('titulo') Convivencias - Inicia sesión o registrate @endsection
@section('section')
<div class="container">
    @if($opcion == 'iniciar')
    @section('navigation')
        @include('layout.navigation')
    @endsection
    <form action="{{ route('log') }}" method="POST">
        {{ csrf_field() }}
        <h1>Inicia sesión</h1>
        <p>Ingresa a la pagina si ya cuentas con tu usuario y contraseña, si no es así puedes registrarte en la sección de registro</p> 
        <br>
        <label for="usuario">Nombre de usuario</label> 
        <input type="text" name="usuario" id="usuario" class="form-control">
        <div class="{{ $errors->has('usuario') ? 'has-error' : '' }}"> 
            {!! $errors->first('usuario', '<span class="help-block">:message</span>') !!}
        </div>
        <label for="password">Contraseña</label> 
        <input type="password" name="password" id="password" class="form-control">
        <div class="{{ $errors->has('password') ? 'has-error' : '' }}"> 
            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
        </div>
        <br>
        <button class="btn btn-success" type="submit"> Acceder</button>
    </form>
    @elseif($opcion == 'registro')
    @section('navigation')
        @include('layout.navigation')
    @endsection
    <form action="{{ route('enviar') }}" method="POST" enctype="multipart/form-data"  onsubmit="myButton.disabled = true; return true;">
        @csrf
        <h1>Envia solicitud para registrarte</h1>
        <p>Ingresa tus datos para poder registrarte en el sistema, debes ingresar tus datos correctamente y adjuntar los archivos para validar tu información. Una vez que mandes la solicitud y se apruebe, se te contactará y podrás iniciar sesión para usar la página</p> 
        <br> 
        <div class="form-group">
            <input class="form-control col-md-5 col-sm-12" autofocus type="text" name="name" placeholder="Nombre(s)">
        </div>
        <div class="form-group">
            <input class="form-control col-md-5 col-sm-12" autofocus type="text" name="paterno" placeholder="Apellido paterno">
            <input class="form-control col-md-5 col-sm-12" autofocus type="text" name="materno" placeholder="Apellido materno">
        </div>
        <div class="form-group label-floating">
            <label for="no_de_control" class="control-label">Sección</label>
            <select class="form-control col-md-5 col-sm-12" name="id_seccion" required>
                    <option value="" disabled="disabled" selected></option>
                    @foreach($secciones as $seccion)
                    <option value="{{$seccion->id}}">{{$seccion->nombre}}</option>
                    @endforeach
            </select> 
        </div>
        <div class="form-group">
            <input class="form-control col-md-5 col-sm-12" required autofocus type="text" name="username" placeholder="Nombre de usuario (Ej. Juan123)">
        </div>
        <div class="form-group">
            <input class="form-control col-md-5 col-sm-12" required type="password" name="password" placeholder="Contraseña">
        </div>
        <hr>
        <h4>Datos de contacto (Por este medio se te enviará tu Confirmación)</h4>
        <div class="form-group">
            <input class="form-control col-md-5 col-sm-12" required type="phone" name="phone" placeholder="Número de teléfono">
        </div>
        <div class="form-group">
            <input class="form-control col-md-5 col-sm-12" type="email" name="email" placeholder="Correo electrónico">
        </div>
        <h4>Acta de nacimiento</h4>
        <div class="form-group">
            <label class="custom-file-upload mr-3">
                <input type="file" size="200" name="acta" id="acta" onchange="loadFile1(event)" accept="image/x-png,image/gif,image/jpeg">
                    Seleccionar acta
            </label>
            <img src="https://cdn.blankstyle.com/files/imagefield_default_images/notfound_0.png" alt="preview" width="70" id="output1"/>
        </div>
        <h4>Comprobante</h4>
        <div class="form-group">
            <label class="custom-file-upload mr-3">
                <input type="file" size="200" name="comprobante" id="comprobante" onchange="loadFile2(event)" accept="image/x-png,image/gif,image/jpeg">
                    Seleccionar comprobante
            </label>
            <img src="https://cdn.blankstyle.com/files/imagefield_default_images/notfound_0.png" alt="preview" width="70" id="output2"/>
        </div>
        <br>
        <button class="btn btn-success" id="submitbutton" name="myButton" type="submit">Enviar solicitud</button>
        <br><br>
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