<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insetir novo conteúdo</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div>
        <form action="{{ route('contents.store') }}" method="POST" class="form-type-ajax">

            @csrf

            <input type="text" name="name" id="name" />
            <textarea name="data" id="data"></textarea>
            <input type="number" name="category_id" id="category_id" value="{{ $categoryId }}" />

            <input type="submit" value="Salvar" />
        </form>
    </div>

    <div class="alert alert-danger form-errors hide"></div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>