@section('navigation')
<nav class="navbar navbar-light">
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


<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>

  <div class="collapse navbar-collapse show" id="navbarNav">
    <ul class="nav justify-content-center">
      <li class="nav-item active">
        <a class="btn nav-link" href="#">Inicio</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Categorías</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Actividades</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Registrarse</a>
      </li>
      <li>
          <a class="nav-link active" href="">Iniciar sesión</a>
      </li>
      <li>
          <a class="nav-link active" href="">Cerrar sesión</a>
      </li>
    </ul>
  </div>

@endsection