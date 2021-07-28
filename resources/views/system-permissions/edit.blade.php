<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar ação de módulo do sistema</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div>
        <form action="{{ route('system.permissions.update') }}" method="POST" class="form-type-ajax">

            @csrf
            @method('PUT')

            <input type="text" name="name" id="name" value="{{ $systemPermission->name }}" placeholder="Nome" />
            <input type="text" name="url_action" id="url_action" value="{{ $systemPermission->url_action }}" placeholder="URL" />
            <input type="text" name="http_method" id="http_method" value="{{ $systemPermission->http_method }}" placeholder="Método HTTP"/>

            <input type="hidden" name="id" id="system_module_action_id" value="{{ $systemPermission->id }}" />
            <input type="hidden" name="system_module_id" id="system_module_id" value="{{ $systemModuleId }}" />

            <input type="submit" value="Salvar" />
        </form>
    </div>

    <div class="alert alert-danger form-errors hide"></div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>