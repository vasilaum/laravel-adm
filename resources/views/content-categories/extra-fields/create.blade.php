<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo campo extra</title>

    <link rel="stylesheet" href="{{ asset('libs/css/app.css') }}" />
</head>
<body>
    <div class="container col-12">
        <form action="{{ route('content.categories.extrafields.store') }}" method="POST" class="form-type-ajax">

            @csrf

            <input type="hidden" name="category_id" id="category_id" value="{{ $categoryId }}" class="form-control" />

            <div class="form-group">
                <label>Nome: </label>
                <input type="text" name="name" class="form-control" placeholder="Nome" />
            </div>
            <div class="form-group">
                <label>Id do campo: </label>
                <input type="text" name="field_id" class="form-control" placeholder="Id do campo" />
            </div>
            <div class="form-group">
                <label>Placeholder: </label>
                <input type="text" name="placeholder" class="form-control" placeholder="Placeholder" />
            </div>
            <div class="form-group">
                <label>Label: </label>
                <input type="text" name="label" class="form-control" placeholder="Label" />
            </div>
            <div class="form-group">
                <label>Máscara do campo: </label>
                <input type="text" name="mask" class="form-control" placeholder="Máscara do campo" />
            </div>
            <div class="form-group">
                <label>Tipo: </label>
                <select name="type" class="form-control" placeholder="Tipo">
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="textarea">Textarea</option>
                    <option value="date">Date</option>
                    <option value="select">Select</option>
                    <option value="radio">Radio</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="email">E-mail</option>
                </select>
            </div>
            <div class="form-group">
                <label>Options: <small>Somente para campos que precisam dessa opção</small></label>
                <input type="text" name="options" class="form-control" placeholder="Options" />
            </div>

            <div class="form-group">
                <input type="submit" value="Salvar" class="form-control" />
            </div>
        </form>
    </div>

    <div class="alert alert-danger form-errors hide"></div>

    <script src="{{ asset('libs/js/app.js') }}"></script>
</body>
</html>