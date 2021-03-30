@section('navigation')
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ route ('inicio.root') }}">Panel Super-Usuario</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route ('inicio.root') }}">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route ('root.admins') }}">Administradores</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route ('root.seccions') }}">Secciones</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route ('root.admins') }}">Superusuarios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('logout') }}">Cerrar sesión</a>
      </li>
    </ul>
  </div>
</nav>
@endsection