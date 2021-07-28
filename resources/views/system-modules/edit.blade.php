<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar módulo do sistema</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div>
        <form action="{{ route('system.modules.update') }}" method="POST" class="form-type-ajax">

            @csrf
            @method('PUT')

            <input type="text" name="name" id="name" value="{{ $systemModule->name }}" />
            <input type="text" name="codename" id="codename" value="{{ $systemModule->codename }}" />

            <input type="hidden" name="id" id="system_module_id" value="{{ $systemModule->id }}" />
            <input type="submit" value="Salvar" />
        </form>
    </div>

    <div class="alert alert-danger form-errors hide"></div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>