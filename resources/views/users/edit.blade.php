<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários Editar</title>
</head>
<body>
    <div>
        <form action="{{ route('users.update') }}" method="POST">

            @csrf
            @method('PUT')

            <input type="text" name="name" id="name" value="{{ $user->name }}" />
            <input type="email" name="email" id="email" value="{{ $user->email }}" />
            <input type="password" name="password" id="password" value="" placeholder="(Não Alterada)" />

            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}" />
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