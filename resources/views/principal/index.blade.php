@extends('layout.layout')
@section('titulo') Convivencias en linea @endsection
@section('navigation')
    @include('layout.navigation')
@endsection
@section('section')
<div id="inicio" class="">
    <div class="container text-center">
        @if(isset(Auth::user()->normal))
            <h1 class="display-4 titulo3">Bienvenido {{Auth::user()->normal->nombre}} {{Auth::user()->normal->apellido_paterno}}</h1>
        @else
            <h1 class="display-4 titulo3">Bienvenidos</h1>
        @endif
        <h3>Aquí podrás realizar muchos</h3>
        <h3>tipos de actividades</h3>
        <audio controls>
            <source src = "/audio/himno.mpeg" type = "audio/mpeg">
        </audio>
        <img class="img-fluid" src="/images/app/hands.png" alt="principal">
    </div>
</div>

<div id="categoria">
    <br><br>
    <div class="container">
        <div class="text-center text-white">
            <h1>Categorías de la semana</h1>
            <p class="d-sm-block d-md-block d-lg-none">Desliza para ver más</p>
            <img class="img-fluid d-sm-block d-md-block d-lg-none" src="/images/app/arrow.png" width="130"  alt="first-arrow">
        </div>
        <div class="table-responsive table-borderless">
            <table id="myTable" class="table text-center">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="id01">
                    <tr>
                    @foreach($categorias as $categoria)
                        <td scope="row">
                            <a href="{{ route ('verCategoria', $categoria->nombre) }}">
                                <div class="wrapper">
                                    <div class="container">
                                        <div class="top" style="background: url('/images/{{$categoria->imagen}}') no-repeat center center;">
                                        </div>
                                        <div class="bottom">
                                            <h2>{{$categoria->nombre}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </td>
                    @endforeach
                        <td scope="row">
                            <a href="{{ url ('categorias') }}">
                                <div class="wrapper">
                                    <div class="container">
                                        <div class="top" style="background: url('/images/app/plus.png') no-repeat center center;">
                                        </div>
                                        <div class="bottom">
                                            <h1>Ver Más</h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
</div>
<div id="actividad">
    <br><br>
    <div class="container">
        <div class="text-center text-white">
            <h1>Actividades</h1>
            <p class="d-sm-block d-md-block d-lg-none">Desliza para ver más</p>
            <img class="img-fluid d-sm-block d-md-block d-lg-none" src="/images/app/arrow.png" width="130" alt="first-arrow">
        </div>
        <div class="table-responsive table-borderless">
            <table id="myTable" class="table text-center">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="id01">
                    <tr>
                    @foreach($actividades as $actividad)
                        <td scope="row">
                            <a href="{{ route ('verActividad', $actividad->nombre) }}">
                                <div class="wrapper">
                                    <div class="container">
                                        <div class="top" style="background: url('/images/{{$actividad->imagen}}') no-repeat center center;">
                                        </div>
                                        <div class="bottom">
                                            <h2>{{$actividad->nombre}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </td>
                    @endforeach
                        <td scope="row">
                            <a href="{{ url ('actividades') }}">
                                <div class="wrapper">
                                    <div class="container">
                                        <div class="top" style="background: url('/images/app/plus.png') no-repeat center center;">
                                        </div>
                                        <div class="bottom">
                                            <h1>Ver Más</h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
</div>
<div id="galeria">
    <div class="container text-white">
        <div class="text-center">
        <br><br>
            <h1>Mira la galería de fotos</h1>
            <br>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        @foreach($fotos as $foto)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->iteration}}" class="active"></li>
        @endforeach
        </ol>
        <div class="carousel-inner">
        @foreach($fotos as $foto)
        @if($loop->iteration == 1)
        <div class="carousel-item active">
            <img class="d-block w-100" src="/images/{{$foto->imagen}}" alt="{{$loop->iteration}}_slide">
        </div>
        @else
        <div class="carousel-item">
            <img class="d-block w-100" src="/images/{{$foto->imagen}}" alt="{{$loop->iteration}}_slide">
        </div>
        @endif
            
        @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
    </div>
    <br>
</div>
@endsection