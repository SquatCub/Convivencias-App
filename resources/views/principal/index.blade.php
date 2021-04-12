@extends('layout.layout')
@section('titulo') Convivencias en linea @endsection
@section('navigation')
    @include('layout.navigation')
@endsection
@section('section')
<div class="container">
    <h1>Principal</h1>
    @if(isset($usuario->normal))
    <h1>Iniciaste sesion como usuario</h1>
    @endif

    <div class="row">
        @foreach($categorias as $categoria)
        <div class="col-md-4">
            <div class="wrapper">
                <div class="container">
                    <div class="top" style="background: url('/images/{{$categoria->imagen}}') no-repeat center center;"></div>
                        <div class="bottom">
                            <div class="left">
                                <div class="details">
                                <h1>{{$categoria->nombre}}</h1>
                                <p class="desc">{{$categoria->descripcion}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
<script>
    desc = document.querySelectorAll('.desc');
    desc.forEach(element=> {
        var aux = "";
        var s = element.innerHTML;
        var i = 0;
        if (s.length < 15) {
            aux+=s;
        } else {
            for (i = 0; i < 15; i++) {
                aux+= s[i];
            }
        }
        aux += '...';
        element.innerHTML = aux;
    });
</script>   

@endsection