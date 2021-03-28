@section('navigation')
<nav>
    <a href="{% url 'index' %}">Inicio</a>
    <a href="">Categorias</a>
    <a href="">Actividades</a>
    <a href="{% url 'logout' %}">Cerrar sesión</a>
    <a href="{% url 'solicitud' %}">Registrarse</a>
    <a href="{% url 'login' %}">Acceder</a>
</nav>
@endsection