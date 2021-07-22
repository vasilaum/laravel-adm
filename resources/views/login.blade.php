<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Administrador</title>

        <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
    </head>
    <body>
        <div class="container">
            <form action="{{ route('auth') }}" method="POST">
                @csrf
                <input type="text" name="email" placeholder="E-mail: "/>
                <input type="password" name="password" placeholder="Senha: "/>
                <button type="submit">Login</button>
            </form>
        </div>

        <script src="{{ asset('libs/js/app.js') }}"></script>
    </body>
</html>
