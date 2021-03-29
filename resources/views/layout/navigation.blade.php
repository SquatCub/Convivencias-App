@section('navigation')
<nav>
    @if(isset($usuario))
    <a href="{{ route ('inicio.usuario') }}">Inicio</a>
    @else 
    <a href="{{ route ('index') }}">Inicio</a>
    @endif
    <a href="">Categorias</a>
    <a href="">Actividades</a>
    @if(isset($usuario->normal))
        <a href="{{ url('logout') }}">Cerrar sesión</a>
    @else
        <a href="{{ url ('login/registro') }}">Registrarse</a>
        <a href="{{ url ('login/iniciar') }}">Acceder</a>
    @endif
</nav>
@endsection