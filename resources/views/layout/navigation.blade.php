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
      <li class="nav-item mr-2">
      @if(Auth::user())
        <a class="btn btn-primary nav-link" href="{{ route ('inicio.usuario') }}">Inicio</a>
      @else
        <a class="btn btn-primary nav-link" href="{{ route ('index') }}">Inicio</a>
      @endif
      </li>
      <li class="nav-item mr-2">
        <a class="btn btn-outline-primary nav-link" href="{{ url ('actividades') }}">Actividades</a>
      </li>
      <li class="nav-item mr-2">
        <a class="btn btn-outline-primary nav-link" href="{{ url ('categorias') }}">Categorías</a>
      </li>
      @if(!Auth::user())
      <div class="d-sm-block d-md-none d-lg-none">
          <li class="nav-item mr-2 mt-2">
            <a class="btn btn-outline-primary nav-link" href="{{ url ('login/registro') }}">Registrarse</a>
          </li>
      </div>
      <div class="d-none d-md-block">
          <li class="nav-item mr-2">
            <a class="btn btn-outline-primary nav-link" href="{{ url ('login/registro') }}">Registrarse</a>
          </li>
      </div>
      @endif
    </ul>
<br>
@endsection