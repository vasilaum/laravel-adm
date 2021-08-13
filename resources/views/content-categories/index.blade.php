<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria de conteúdos</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div class="container col-12">
        <div class="col-12">
            <a href="{{ route('content.categories.form') }}" class="btn btn-info">Novo</a>
            <a href="{{ route('home') }}" class="btn btn-info">Voltar p/ menu</a>
        </div>

        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Conteúdos</th>
                            <th scope="col">Campos extras nos conteúdos</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('contents.index', ['categoryId' => $category->id]) }}">Conteúdos</a>
                                </td>
                                <td>
                                    <a href="{{ route('content.categories.extrafields.index', ['categoryId' => $category->id]) }}">Campos Extras</a>
                                </td>
                                <td>
                                    <a href="{{ route('content.categories.form', ['id' => $category->id]) }}" class="btn btn-warning">Editar</a>
                                </td>
                                <td>
                                    <button href="#" class="btn btn-danger btn-destroy-ajax" data-url="{{ route('content.categories.destroy', ['id' => $category->id]) }}">Deletar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-12">
            {{ $categories->links() }}
        </div>
    </div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>