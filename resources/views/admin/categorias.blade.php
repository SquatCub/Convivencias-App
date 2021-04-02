@extends('layout.layout')
@section('titulo') Panel Administrador - Categorias @endsection
@section('section')
@include('admin.navigation')
<div class="container card">
    <br>
    <h1>Categorías</h1>
    <div class="text-right">
        <a href="{{ route ('categoria.new') }}" class="btn btn-success text-white">Añadir nueva categoría</a>
    </div>
    <br>
    <div class="container">
        <table id="myTable" class="table table-hover text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"># <button id="0" class="btn btn-sm sort" onclick="sortTable(0)">^</button></th>
                    <th scope="col">Nombre <button id="1" class="btn btn-sm sort" onclick="sortTable(1)">^</button></th>
                    <th scope="col">Descripción <button id="2" class="btn btn-sm sort" onclick="sortTable(2)">^</button></th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td scope="row">{{ $categoria->nombre }}</td>
                <td class="desc" scope="row">{{ $categoria->descripcion }}</td>
                <td scope="row"><a href="{{ route ('seccion.editar', $categoria) }}" class="btn btn-primary btn-sm">Editar</a> <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete{{ $categoria->id }}">Eliminar</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    desc = document.querySelectorAll('.desc');
    desc.forEach(element=> {
        var aux = "";
        var s = element.innerHTML;
        var i = 0;
        if (s.length < 30) {
            aux+=s;
        } else {
            for (i = 0; i < 30; i++) {
                aux+= s[i];
            }
        }
        aux += '...';
        element.innerHTML = aux;
    });
</script>
@endsection