<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permissões</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div>
        <form action="{{ route('users.permissions.store', ['userId' => $userId] ) }}" method="POST" class="form-type-ajax">

            @csrf

            @foreach ($userPermissions as $permission)
                <label>{{ $permission->name }}</label>
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" checked />
            @endforeach
            <hr />
            @foreach ($othersPermissions as $permission)
                <label>{{ $permission->name }}</label>
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" />
            @endforeach

            <input type="submit" value="Salvar" />
        </form>
    </div>

    <div class="alert alert-danger form-errors hide"></div>

    <div>
        <a href="{{ route('users.index') }}">Voltar</a>
    </div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>