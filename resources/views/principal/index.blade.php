@extends('layout.layout')
@section('titulo') Convivencias en linea @endsection
@section('navigation')
    @include('layout.navigation')
@endsection
@section('section')
<div class="container text-center">
    @if(Auth::user())
        <h1 class="display-4 titulo2">Bienvenido {{Auth::user()->normal->nombre}} {{Auth::user()->normal->apellido_paterno}}</h1>
    @else
        <h1 class="display-4 titulo2">Bienvenidos</h1>
    @endif
    <h3>Aquí podrás realizar muchos</h3>
    <h3>tipos de actividades</h3>
    <img class="img-fluid" src="/images/app/hands.png" alt="principal">
    
</div>
<div id="categoria">
    <br><br>
    <div class="container">
        <div class="text-center text-white">
            <h1>Categorías</h1>
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
                            <a href="{{ route ('verActividad', $categoria->nombre) }}">
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

<div class="bg-dark" id="footer">
<br><br><br>
</div>

@endsection