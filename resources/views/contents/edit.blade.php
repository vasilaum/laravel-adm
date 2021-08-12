<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar conteúdo</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div class="container col-12">
        <form action="{{ route('contents.store') }}" method="POST" class="form-type-ajax">

            @csrf
            @method("PUT")

            <input type="hidden" name="id" id="content_id" value="{{ $content->id }}" />
            <input type="hidden" name="category_id" id="category_id" value="{{ $content->category_id }}" />

            <div class="form-group">
                <label>Nome ou Título</label>
                <input type="text" name="name" id="name" value="{{ $content->name }}" class="form-control" />
            </div>
            <div class="form-group">
                <label>Texto</label>
                <textarea name="data" id="data" class="form-control">{{ $content->data }}</textarea>
            </div>

            @include('def.generate-extra-fields-edit')

            <div class="form-group">
                <input type="submit" value="Salvar" />
            </div>
        </form>
    </div>

    <div class="alert alert-danger form-errors hide"></div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>