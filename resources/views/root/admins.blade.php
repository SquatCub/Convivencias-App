@extends('layout.layout')
@section('titulo') Panel Super-Usuario @endsection
@section('section')
@include('root.navigation')
<h1>Administradores</h1>
<br>
@foreach($admins as $admins)
    <h1>Admin</h1>
@endforeach

@endsection