<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload test</title>
</head>
<body>
    <div class="container text-center">
            <h1>Registrarse</h1>
            <h2>Se enviará la solicitud a un administrador, si este lo aprueba podrás ingresar a todas las funciones.</h2>
            <form method="POST" action="{{ route('enviar') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input class="form-control" autofocus type="text" name="username" placeholder="Nombre de usuario (Ej. Juan123)">
                </div>
                <h4>Datos de contacto (Por este medio se te enviará tu contraseña)</h4>
                    <input type="file" name="acta" id="acta" accept="image/x-png,image/gif,image/jpeg">
                </div>
                <br>
                <button data-action='submit'>Mandar solicitud</button>
            </form>
            <br>
            ¿Ya tienes tu cuenta? <a href="{% url 'login' %}">Ingresa aqui.</a>
        </div>
    </div>
</body>
</html>