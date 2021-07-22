<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insetir novo módulo do sistema</title>
</head>
<body>
    <div>
        <form action="{{ route('system.modules.store') }}" method="POST">

            @csrf

            <input type="text" name="name" id="name" value="{{ old('name') }}" />
            <input type="text" name="codename" id="codename" value="{{ old('codename') }}" />
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