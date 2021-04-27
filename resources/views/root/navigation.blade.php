@section('navigation')
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <img src="https://0201.nccdn.net/1_2/000/000/0ad/535/82bd9199ec924570988980d85326d9ff.png" alt="logo" width="20" height="30" id="logo_sntsa">
  <a class="navbar-brand" href="{{ route ('inicio.root') }}">Panel Super-Usuario</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link btn btn-outline-success" href="{{ route ('inicio.root') }}">Inicio</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link btn btn-outline-success" href="{{ route ('root.admins') }}">Administradores</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link btn btn-outline-success" href="{{ route ('root.seccions') }}">Secciones</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link btn btn-outline-success" href="{{ route ('root.superusers') }}">Superusuarios</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link btn btn-outline-danger" href="{{ url('logout') }}">Cerrar sesión</a>
      </li>
    </ul>
  </div>
</nav>
<br>
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