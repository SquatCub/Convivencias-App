@extends('layout.layout')
@section('titulo') Panel Super-Usuario @endsection
@section('section')
@include('root.navigation')
<div class="container card">
<br>
    <h1>Secciones</h1>
    <div class="text-right">
        <a href="{{ route ('seccion.new') }}" class="btn btn-warning">Añadir nueva sección</a>
    </div>
    <br>

    <table class="table table-hover text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($areas as $area)
            <tr>
            <td scope="row">{{ $loop->iteration }}</td>
            <td scope="row">{{ $area->nombre }}</td>
            <td scope="row"><a href="" class="btn btn-primary btn-sm">Editar</a> <a href="" class="btn btn-danger btn-sm">Eliminar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection