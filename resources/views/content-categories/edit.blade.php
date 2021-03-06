<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar categoria de conteúdo</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div>
        <form action="{{ route('content.categories.update') }}" method="POST" class="form-type-ajax">

            @csrf
            @method('PUT')

            <input type="text" name="name" id="name" value="{{ $category->name }}" />

            <input type="hidden" name="id" id="content_category_id" value="{{ $category->id }}" />
            <input type="submit" value="Salvar" />
        </form>
    </div>

    <div class="alert alert-danger form-errors hide"></div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>