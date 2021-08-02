<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conteúdos</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div>
        <a href="{{ route('contents.form', ['categoryId' => $categoryId]) }}">Novo</a>
    </div>
    <div>
        @foreach ($contents as $content)
            <p>{{ $content->id }}</p>
            <p>{{ $content->name }}</p>
            <p>{{ $content->data }}</p>
            <p>
                <a href="{{ route('contents.form', ['id' => $content->id]) }}">Editar</a>
            </p>
            <p>
                <a href="{{ route('content.images.index', ['contentId' => $content->id]) }}">Imagens</a>
            </p>
            <p>
                <button href="#" class="btn btn-danger btn-destroy-ajax" data-url="{{ route('contents.destroy', ['id' => $content->id]) }}">Deletar</button>
            </p>
        @endforeach
    </div>

    <div>
        {{ $contents->links() }}
    </div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>