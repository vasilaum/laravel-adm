<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conteúdos</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div class="container col-12">
        <div class="col-12">
            <a href="{{ route('contents.form', ['categoryId' => $categoryId]) }}" class="btn btn-info">Novo</a>
            <a href="{{ route('content.categories.index') }}" class="btn btn-info">Voltar p/ Categorias</a>
        </div>

        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Imagens</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($contents as $content)
                                <td>{{ $content->id }}</td>
                                <td>{{ $content->name }}</td>
                                <td>
                                    <a href="{{ route('content.images.index', ['contentId' => $content->id]) }}">Imagens</a>
                                </td>
                                <td>
                                    <a href="{{ route('contents.form', ['id' => $content->id]) }}" class="btn btn-warning">Editar</a>
                                </td>
                                <td>
                                    <button href="#" class="btn btn-danger btn-destroy-ajax" data-url="{{ route('contents.destroy', ['id' => $content->id]) }}">Deletar</button>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-12">
            {{ $contents->links() }}
        </div>
    </div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>