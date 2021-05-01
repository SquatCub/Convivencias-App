@extends('layout.layout')
@section('titulo') Convivencias en linea @endsection
@section('navigation')
    @include('layout.navigation')
@endsection
@section('section')
<div class="container text-center">
    <h1 class="display-4 titulo2">Actividades de {{$categoria->nombre}}</h1>
    <h2>{{$categoria->descripcion}}</h2>
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