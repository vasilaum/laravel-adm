<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ações dos módulos do sistema</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div>
        <a href="{{ route('system.permissions.form', ['moduleId' => $systemModuleId]) }}">Novo</a>
    </div>
    <div>
        @foreach ($systemModulesActions as $action)
            <p>{{ $action->id }}</p>
            <p>{{ $action->name }}</p>
            <p>{{ $action->url_action }}</p>
            <p>
                <a href="{{ route('system.permissions.form', ['moduleId' => $systemModuleId, 'id' => $action->id]) }}">Editar</a>
            </p>
            <p>
                <button href="#" class="btn btn-danger btn-system-permission-destroy" value="{{ $action->id }}">Deletar</button>
            </p>
        @endforeach
    </div>

    <div>
        {{ $systemModulesActions->links() }}
    </div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>