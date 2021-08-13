<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagens</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div class="container col-12">
        <div class="col-12">
            <form method="POST" action="{{ route('content.images.store') }}" class="form-type-ajax" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="content_id" value="{{ $contentId }}" />

                <div class="form-group">
                    <input type="file" name="files[]" class="form-control" multiple />
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit" class="form-control"/>
                </div>
            </form>
        </div>

        <hr />

        <div class="alert alert-danger form-errors col-12 hide"></div>

        <hr />

        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-3">
                    <img src="{{ route('get.storage.images', ['filename' => 'contents--' . $image->path]) }}" width="100" />
                    <button href="#" class="btn btn-danger btn-destroy-ajax" data-url="{{ route('content.images.destroy', ['id' => $image->id]) }}">Deletar</button>
                </div>
                <div class="col-md-9">
                    <form action="{{ route('content.images.update') }}" method="POST" class="form-type-ajax">

                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ $image->id }}" />

                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" name="title" value="{{ $image->title }}" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Ordem</label>
                            <input type="number" name="order" value="{{ $image->order }}" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Salvar" class="form-control" />
                        </div>
                    </form>
                </div>

                <hr />
            @endforeach
        </div>

        <div class="col-12">
            {{ $images->links() }}
        </div>
    </div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>