@extends('layout.layout')
@section('titulo')Convivencias en linea@endsection
@section('section')
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Bienvenido de nuevo {{$alumno->nombre.' '.$alumno->apellido_paterno}}</h3>
            </div>
            <div class="panel-body text-center">
                <h4>{{$alumno->usuario->usuario}}<br>{{$alumno->nombre.' '.$alumno->apellido_paterno}}</h4>
                <p>Aquí puedes visualizar informacion acerca de los Circulos de Estudio que se imparten, puedes realizar una solicitud para impartir alguno de nuestras materias disponibles. Para mas informacion puedes acercarte al jefe de departamento de tu carrera.</p>
            </div>
        </div>
    </div>
</div>
@endsection