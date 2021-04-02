@section('navigation')
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ route ('inicio.root') }}">Panel Administrador</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route ('inicio.root') }}">Inicio</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ route ('root.admins') }}">Categorías</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ route ('root.seccions') }}">Actividades</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ route ('root.superusers') }}">Usuarios</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('logout') }}">Cerrar sesión</a>
      </li>
    </ul>
  </div>
</nav>
@if(session()->has('message'))
<br>
<div class="container alert alert-success alert-dismissible fade show" role="alert">
<div class="container card">
<strong>Correcto</strong>  {{ session()->get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
</div>
@elseif(session()->has('error'))
<br>
<div class="container alert alert-danger alert-dismissible fade show" role="alert">
<div class="container card">
<strong>Error</strong>  {{ session()->get('error') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
</div>
@endif
@endsection