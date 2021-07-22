<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Administrador</title>

        <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
    </head>
    <body>
        <ul>
            <li><a href="{{ route('users.index') }}">Usuários</a></li>
            <li><a href="{{ route('system.modules.index') }}">Módulos</a></li>
            <li><a href="{{ route('content.categories.index') }}">Conteúdos :: Categorias</a></li>
        </ul>
        <script src="{{ asset('libs/js/app.js') }}"></script>
    </body>
</html>
