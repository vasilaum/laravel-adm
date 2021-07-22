<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir nova categoria de conteúdo</title>
</head>
<body>
    <div>
        <form action="{{ route('content.categories.store') }}" method="POST">

            @csrf

            <input type="text" name="name" id="name" value="{{ old('name') }}" />
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