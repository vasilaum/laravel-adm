<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campos extras</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div>
        <a href="{{ route('content.categories.extrafields.form', ['categoryId' => $categoryId]) }}">Novo</a>
    </div>
    <div>
        @foreach ($extraFields as $field)
            <p>{{ $field->id }}</p>
            <p>{{ $field->name }}</p>
            <p>
                <button href="#" class="btn btn-danger btn-destroy-ajax" data-url="{{ route('content.categories.extrafields.destroy', ['id' => $field->id]) }}">Deletar</button>
            </p>
        @endforeach
    </div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>