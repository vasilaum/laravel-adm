<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar categoria de conteúdo</title>
</head>
<body>
    <div>
        <form action="{{ route('content.categories.update') }}" method="POST">

            @csrf
            @method('PUT')

            <input type="text" name="name" id="name" value="{{ $category->name }}" />

            <input type="hidden" name="id" id="content_category_id" value="{{ $category->id }}" />
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