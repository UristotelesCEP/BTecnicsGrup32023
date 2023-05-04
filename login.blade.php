<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/app.scss'])

</head>

<body>
    <div style="margin-top: 10%;" class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <img src="img/logo.png" alt="logo" class="img-fluid">
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/login') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control" placeholder="Username" id="username">
                                <label for="username">Usuari</label>
                            </div>

                            <div class="input-group mb-3">
                                <div class="form-floating">
                                    <input type="password" name="password" class="form-control me-1" placeholder="Password" id="password">
                                    <label for="password">Contrasenya</label>
                                </div>
                                <span class="input-group-text" onclick="mostrarLletres()">
                                    <i id="icon" class="bi bi-eye-slash-fill"></i>
                                </span>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                            @if (session('error'))
                                <div class="alert alert-danger  mt-4">{{ session('error') }}</div>
                            @endif

                            <p class="message"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function mostrarLletres() {
            var password = document.getElementById("password");
            var icon = document.getElementById("icon");
            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("bi-eye-slash-fill");
                icon.classList.add("bi-eye-fill");
            } else {
                password.type = "password";
                icon.classList.remove("bi-eye-fill");
                icon.classList.add("bi-eye-slash-fill");
            }
        }
    </script>

</body>

</html>
