<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Pegando o token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>

        <!-- Conteudo -->
        <div id ="app"> 
            <!-- Components -->
            <preloader-component></preloader-component>
            <router-view></router-view> 
        </div>

        <!-- JavaScript -->
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
