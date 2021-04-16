@extends('layout.layout')
@section('titulo') Convivencias en linea @endsection
@section('navigation')
    @include('layout.navigation')
@endsection
@section('section')
<div class="container text-center">
    <h1 class="display-4 titulo2">Todas las categorías</h1>
    <h3>En esta sección se encuentran listadas todas las categorías</h3>
    @if(isset($usuario->normal))
    <h1>Iniciaste sesion como usuario</h1>
    @endif
</div>
<div id="categoria">
    <br><br>
    <div class="container text-center">
        <div class="row">
            @foreach($categorias as $categoria)
            <div class="col-md-6 col-lg-4">
                <div class="wrapper">
                    <div class="container">
                        <div class="top" style="background: url('/images/{{$categoria->imagen}}') no-repeat center center;">
                        </div>
                        <div class="bottom">
                            <h2>{{$categoria->nombre}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection