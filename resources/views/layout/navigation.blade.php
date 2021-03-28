@section('navigation')
<nav>
    <a href="{{ route ('index') }}">Inicio</a>
    <a href="">Categorias</a>
    <a href="">Actividades</a>
    @if(isset($usuario))
        <a href="{{ url('logout') }}">Cerrar sesión</a>
    @else
        <a href="{{ url ('login/registro') }}">Registrarse</a>
        <a href="{{ url ('login/iniciar') }}">Acceder</a>
    @endif
</nav>
@endsection