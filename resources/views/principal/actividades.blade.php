@extends('layout.layout')
@section('titulo') Convivencias en linea @endsection
@section('navigation')
    @include('layout.navigation')
@endsection
@section('section')
<div class="container text-center">
    <h1 class="display-4 titulo2">Todas las actividades</h1>
    <h3>Aquí están todas las actividades que puedes realizar</h3>
    @if(isset($usuario->normal))
    <h1>Iniciaste sesion como usuario</h1>
    @endif
</div>
<div id="actividad">
    <br><br>
    <div class="container text-center">
        <div class="row">
            @foreach($actividades as $actividad)
            <div class="col-md-4">
                <a href="{{ route ('verActividad', $actividad->nombre) }}">
                    <div class="wrapper">
                        <div class="container">
                            <div class="top" style="background: url('/images/{{$actividad->imagen}}') no-repeat center center;">
                            </div>
                            <div class="bottom">
                                <h2>{{$actividad->nombre}}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection