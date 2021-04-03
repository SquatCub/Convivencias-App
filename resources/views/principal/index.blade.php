@extends('layout.layout')
@section('titulo') Convivencias en linea @endsection
@section('navigation')
    @include('layout.navigation')
@endsection
@section('section')
<div class="container">
    <h1>Principal</h1>
    @if(isset($usuario->normal))
    <h1>Iniciaste sesion como usuario</h1>
    @endif

    @foreach($categorias as $categoria)
    {{$categoria->nombre}}
    <br>
    @endforeach

</div>

@endsection