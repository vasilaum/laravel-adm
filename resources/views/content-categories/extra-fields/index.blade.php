<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campos extras</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div class="container col-12">
        <div class="col-12">
            <a class="btn btn-info" href="{{ route('content.categories.extrafields.form', ['categoryId' => $categoryId]) }}">Novo</a>
            <a class="btn btn-info" href="{{ route('content.categories.index') }}">Voltar p/ categorias</a>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">type</th>
                            <th scope="col">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($extraFields as $field)
                            <tr>
                                <td>{{ $field->id }}</td>
                                <td>{{ $field->name }}</td>
                                <td>{{ $field->type }}</td>
                                <td>
                                    <button href="#" class="btn btn-danger btn-destroy-ajax" data-url="{{ route('content.categories.extrafields.destroy', ['id' => $field->id]) }}">Deletar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>