<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria de conteúdos</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div>
        <a href="{{ route('content.categories.form') }}">Novo</a>
    </div>
    <div>
        @foreach ($categories as $category)
            <p>{{ $category->id }}</p>
            <p>{{ $category->name }}</p>
            <p>
                <a href="{{ route('content.categories.form', ['id' => $category->id]) }}">Editar</a>
            </p>
            <p>
                <a href="{{ route('contents.index', ['categoryId' => $category->id]) }}">Conteúdos</a>
            </p>
            <p>
                <button href="#" class="btn btn-danger btn-content-category-destroy" value="{{ $category->id }}">Deletar</button>
            </p>
        @endforeach
    </div>

    <div>
        {{ $categories->links() }}
    </div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>