@section('navigation')
<br>
<div class="container">
<div class="row text-center">
    <div class="col">
      <img class="img-fluid" width="30" src="/images/app/logo_sntsa.webp" alt="logo_sntsa">
    </div>
    <div class="col">
      <h4 class="titulo">CONVIVENCIAS VIRTUALES</h4>
    </div>
    @if(Auth::user())
    <div class="col">
        <a class="btn btn-sm btn-outline-danger" href="{{ url ('logout') }}">Salir</a>
    </div>
    @else
    <div class="col">
      <a class="btn btn-sm btn-success" href="{{ url ('login/iniciar') }}">Acceder</a>
    </div>
    @endif
</div>
</div>
<br>
    <ul class="nav justify-content-center">
      <li class="nav-item mr-1 p-1">
      @if(Auth::user())
        <a class="btn @if($opt == 'inicio') btn-primary @else btn-outline-primary @endif nav-link" href="{{ route ('inicio.usuario') }}">Inicio</a>
      @else
        <a class="btn @if($opt == 'inicio') btn-primary @else btn-outline-primary @endif nav-link" href="{{ route ('index') }}">Inicio</a>
      @endif
      </li>
      <li class="nav-item mr-1 p-1">
        <a class="btn @if($opt == 'actividades') btn-primary @else btn-outline-primary @endif nav-link" href="{{ url ('actividades') }}">Actividades</a>
      </li>
      <li class="nav-item mr-1 p-1">
        <a class="btn @if($opt == 'categorias') btn-primary @else btn-outline-primary @endif nav-link" href="{{ url ('categorias') }}">Categorías</a>
      </li>
      <li class="nav-item mr-1 p-1">
        <a class="btn @if($opt == 'galeria') btn-primary @else btn-outline-primary @endif nav-link" href="{{ url ('galeria') }}">Galería</a>
      </li>
      @if(!Auth::user())
      <li class="nav-item mr-1 p-1">
        <a class="btn @if($opt == 'registro') btn-primary @else btn-outline-primary @endif nav-link" href="{{ url ('login/registro') }}">Registrarse</a>
      </li>
      @endif
    </ul>
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