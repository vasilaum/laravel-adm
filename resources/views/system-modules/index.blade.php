<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulos do sistema</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div>
        <a href="{{ route('system.modules.form') }}">Novo</a>
    </div>
    <div>
        @foreach ($systemModules as $systemModule)
            <p>{{ $systemModule->id }}</p>
            <p>{{ $systemModule->name }}</p>
            <p>{{ $systemModule->codename }}</p>
            <p>
                <a href="{{ route('system.modules.form', ['id' => $systemModule->id]) }}">Editar</a>
            </p>
            <p>
                <a href="{{ route('system.permissions.index', ['moduleId' => $systemModule->id]) }}">Permissões</a>
            </p>
            <p>
                <button href="#" class="btn btn-danger btn-system-module-destroy" value="{{ $systemModule->id }}">Deletar</button>
            </p>
        @endforeach
    </div>

    <div>
        {{ $systemModules->links() }}
    </div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>