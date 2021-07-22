<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar módulo do sistema</title>
</head>
<body>
    <div>
        <form action="{{ route('system.modules.update') }}" method="POST">

            @csrf
            @method('PUT')

            <input type="text" name="name" id="name" value="{{ $systemModule->name }}" />
            <input type="text" name="codename" id="codename" value="{{ $systemModule->codename }}" />

            <input type="hidden" name="id" id="system_module_id" value="{{ $systemModule->id }}" />
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