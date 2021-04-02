@foreach($categorias as $categoria)
    {{$categoria->nombre}}
    <img src="/images/{{$categoria->imagen}}" width="200" alt="">
    <br>
@endforeach