<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir novo conteúdo</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div>
        <form action="{{ route('contents.store') }}" method="POST" class="form-type-ajax">

            @csrf

            <input type="hidden" name="category_id" id="category_id" value="{{ $categoryId }}" />

            <div class="form-group">
                <label>Nome ou Título: </label>
                <input type="text" name="name" id="name" class="form-control" />
            </div>
            <div class="form-group">
                <label>Texto: </label>
                <textarea name="data" id="data" class="form-control"></textarea>
            </div>

            <hr />

            @include('def.generate-extra-fields-create')

            <div class="form-group">
                <input type="submit" value="Salvar" class="form-control" />
            </div>
        </form>
    </div>

    <div class="alert alert-danger form-errors hide"></div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>