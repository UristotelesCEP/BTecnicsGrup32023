<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/app.scss'])
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Editar Usuari</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('usuaris.update', $usuari) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mt-5">
                        <div class="input-group">
                            <label for="nom" class="input-group-text">Nom:</label>
                            <input type="text" class="form-control" id="nom" name="nom"
                                value="{{ $usuari->nom }}">
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="input-group">
                            <label for="cognoms" class="input-group-text">Cognoms:</label>
                            <input type="text" class="form-control" id="cognoms" name="cognoms"
                                value="{{ $usuari->cognoms }}">
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="input-group">
                            <label for="username" class="input-group-text">Nom d'usuari:</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ $usuari->username }}">
                        </div>
                    </div>
                    

                    <div class="form-group mt-3">
                        <div class="input-group">
                            <label for="tipus_usuaris_id" class="input-group-text">Tipus d'usuari:</label>
                            <select class="form-control" id="tipus_usuaris_id" name="tipus_usuaris_id">
                                <option value="1" {{ $usuari->tipus_usuaris_id == 1 ? 'selected' : '' }}>Operador
                                    112</option>
                                <option value="2" {{ $usuari->tipus_usuaris_id == 2 ? 'selected' : '' }}>Supervisor
                                    112</option>
                                <option value="3" {{ $usuari->tipus_usuaris_id == 3 ? 'selected' : '' }}>
                                    Administrador Sistema</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Acceptar</button>
                        <a href="{{ route('gestioUsuaris') }}" class="btn btn-secondary ml-2">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


</html>
