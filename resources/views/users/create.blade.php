<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários Novo</title>
</head>
<body>
    <div>
        <form action="{{ route('users.store') }}" method="POST">

            @csrf

            <input type="text" name="name" id="name" value="{{ old('name') }}" />
            <input type="email" name="email" id="email" value="{{ old('email') }}" />
            <input type="password" name="password" id="password" value="{{ old('password') }}" />
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