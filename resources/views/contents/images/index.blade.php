<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagens</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div>
        <form method="POST" action="{{ route('content.images.store') }}" class="form-type-ajax" enctype="multipart/form-data">
            @csrf

            <input type="file" name="files[]" multiple />
            <input type="hidden" name="content_id" value="{{ $contentId }}" />
            <button type="submit">Submit</button>
        </form>
    </div>

    <div class="alert alert-danger form-errors hide"></div>

    <div>
        @foreach ($images as $image)
            <form action="{{ route('content.images.update') }}" method="POST" class="form-type-ajax">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $image->id }}" />
                <input type="text" name="title" value="{{ $image->title }}" />
                <input type="number" name="order" value="{{ $image->order }}" />
                <input type="submit" value="Salvar" />
            </form>
            <img src="{{ route('get.storage.images', ['filename' => 'contents--' . $image->path]) }}" width="100" />
            <p>
                <button href="#" class="btn btn-danger btn-destroy-ajax" data-url="{{ route('content.images.destroy', ['id' => $image->id]) }}">Deletar</button>
            </p>
        @endforeach
    </div>

    <div>
        {{ $images->links() }}
    </div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>