<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insetir nova ação de módulo do sistema</title>
</head>
<body>
    <div>
        <form action="{{ route('system.permissions.store') }}" method="POST">

            @csrf

            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Nome" />
            <input type="text" name="url_action" id="url_action" value="{{ old('url_action') }}" placeholder="URL" />
            <input type="text" name="http_method" id="http_method" value="{{ old('http_method') }}" placeholder="Método HTTP"/>

            <input type="hidden" name="system_module_id" id="system_module_id" value="{{ $systemModuleId }}" />

            <input type="submit" value="Salvar" />
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