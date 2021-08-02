<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div>
        <a href="{{ route('users.form') }}">Novo</a>
    </div>
    <div>
        @foreach ($users as $user)
            <p>{{ $user->id }}</p>
            <p>{{ $user->name }}</p>
            <p>
                <a href="{{ route('users.form', ['id' => $user->id]) }}">Editar</a>
            </p>
            <p>
                <button href="#" class="btn btn-danger btn-destroy-ajax" data-url="{{ route('users.destroy', ['id' => $user->id]) }}">Deletar</button>
            </p>
            <p>
                <a href="{{ route('users.permissions.index', ['userId' => $user->id]) }}">Permissões</a>
            </p>
        @endforeach
    </div>

    <div>
        {{ $users->links() }}
    </div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>