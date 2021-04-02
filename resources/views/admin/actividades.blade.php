@extends('layout.layout')
@section('titulo') Panel Administrador - Categorias @endsection
@section('section')
@include('admin.navigation')
@foreach($categorias as $categoria)
    {{$categoria->nombre}}
    <img src="/images/{{$categoria->imagen}}" width="200" alt="">
    <br>
@endforeach
@endsection