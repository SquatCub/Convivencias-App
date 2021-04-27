<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="icon" href="https://0201.nccdn.net/1_2/000/000/0ad/535/82bd9199ec924570988980d85326d9ff.png" type="image/png">
    <title>@yield('titulo')</title>
</head>
<body>
    @yield('navigation')
    @yield('section')
    @include('layout.footer')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/myjs.js') }}"></script>
    <script src="{{ asset('js/validation.js') }}"></script>
</body>
</html>