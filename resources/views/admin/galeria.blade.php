@extends('layout.layout2')
@section('titulo') Panel Administrador - Actividades @endsection
@section('section')
@include('admin.navigation')
<div class="container card">
    <br>
    <h1>Galería de fotos</h1>
    <h3>Son las imagenes que aparecen en la página principal</h3>
    <div class="text-right">
        <a href="{{ route ('foto.new') }}" class="btn btn-success text-white">Añadir nueva foto</a>
    </div>
    <hr>
    <div class="row">
        @foreach($fotos as $foto)
        <div class="col d-flex align-items-center justify-content-center p-2">
            <div class="text-right" style="background: url('/images/{{$foto->imagen}}') no-repeat center center; width:300px; height:200px;background-size: cover;"><a class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#modalDelete{{ $foto->id }}">Eliminar</a></div>
        </div>


        <!-- Modals para eliminacion -->
        <div class="modal fade" id="modalDelete{{ $foto->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmación de eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <h4>¿Está seguro de querer eliminar la imagen?</h4><br>
                    <img src="/images/{{$foto->imagen}}" alt="{{$loop->iteration}}" class="img-fluid">
            </div>
            <div class="modal-footer">
                <form action="{{ route('foto.eliminar', $foto->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-default btn-raised" data-dismiss="modal">Cancelar</button>
                    <button type="sumbmit" class="btn btn-warning btn-raised" id="cursos-confirm-delete">Eliminar</button>
                </form>
            </div>
            </div>
        </div>
        </div>
        @endforeach
    </div>
</div>
@endsection