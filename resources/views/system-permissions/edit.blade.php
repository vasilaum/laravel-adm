<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar ação de módulo do sistema</title>
</head>
<body>
    <div>
        <form action="{{ route('system.permissions.update') }}" method="POST">

            @csrf
            @method('PUT')

            <input type="text" name="name" id="name" value="{{ $systemPermission->name }}" placeholder="Nome" />
            <input type="text" name="url_action" id="url_action" value="{{ $systemPermission->url_action }}" placeholder="URL" />
            <input type="text" name="http_method" id="http_method" value="{{ $systemPermission->http_method }}" placeholder="Método HTTP"/>

            <input type="hidden" name="id" id="system_module_action_id" value="{{ $systemPermission->id }}" />
            <input type="hidden" name="system_module_id" id="system_module_id" value="{{ $systemModuleId }}" />

            <input type="submit" value="Salvar" />
            <button type="button" onclick="javascript:window.history.back(-2)">Voltar</button>
        </form>
    </div>
    <div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>