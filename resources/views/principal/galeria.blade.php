@extends('layout.layout')
@section('titulo') Convivencias en linea @endsection
@section('navigation')
    @include('layout.navigation')
@endsection
@section('section')
<div class="container text-center">
    <h1 class="display-4 titulo2">Galería de fotos</h1>
</div>
<div id="galeria">
    <br><br>
    <div class="container text-center">
        <div class="row">
            @foreach($fotos as $foto)
            <div class="col d-flex align-items-center justify-content-center p-2">
                <div class="text-right" style="background: url('/images/{{$foto->imagen}}') no-repeat center center; width:300px; height:200px;background-size: cover;"></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection