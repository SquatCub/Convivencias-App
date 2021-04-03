@extends('layout.layout')
@section('titulo') Convivencias - Inicia sesión o registrate @endsection
@section('section')

@if($opcion == 'iniciar')
@section('navigation')
    @include('layout.navigation')
@endsection
<form action="{{ route('log') }}" method="POST">
    {{ csrf_field() }}
    <p class="text-center">Ingresa a la pagina si ya cuentas con tu usuario y contraseña, si no es así puedes registrarte en la sección de registro</p> 
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
    <button type="submit"> Acceder</button>
</form>
@elseif($opcion == 'registro')
@section('navigation')
    @include('layout.navigation')
@endsection
<form action="" method="POST">
    @csrf
    <p class="text-center">Ingresa tus datos para poder registrarte en el sistema, debes ingresar tus datos correctamente y adjuntar los archivos para validar tu información. Una vez que mandes la solicitud y se apruebe, se te contactará y podrás iniciar sesión para usar la página</p> 
    <br> 
    <div class="form-group">
        <input class="form-control" autofocus type="text" name="name" placeholder="Nombre(s)">
    </div>
    <div class="form-group">
        <input class="form-control" autofocus type="text" name="lastname" placeholder="Apellido(s)">
    </div>
    <div class="form-group">
        <input class="form-control" autofocus type="text" name="username" placeholder="Nombre de usuario (Ej. Juan123)">
    </div>
    <div class="form-group">
        <input class="form-control" type="password" name="password" placeholder="Contraseña">
    </div>
    <h4>Datos de contacto (Por este medio se te enviará tu contraseña)</h4>
    <div class="form-group">
        <input class="form-control" type="phone" name="phone" placeholder="Número de teléfono">
    </div>
    <div class="form-group">
        <input class="form-control" type="email" name="email" placeholder="Correo electrónico">
    </div>
    <h4>Imagen</h4>
    <div class="form-group">
        <input type="file" name="acta" id="acta" accept="image/x-png,image/gif,image/jpeg">
    </div>
    <br>
    <button data-action='submit'>Enviar solicitud</button>
</form>
@endif
@endsection