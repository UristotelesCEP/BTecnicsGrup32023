<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/app.scss'])

    

    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{ route('inici') }}"><img src="{{asset('img/ArrowLeft.svg')}}" alt="Imagen"  class="ArrowLeft"></a>

            <!-- Icono de la aplicación y ajuste de la posición -->
            <img src="{{asset('img/Logo.png')}}" alt="Imagen"  class="ms-4 navImage">

            <!-- Botón para el usuario -->
            <div class="d-flex justify-content-end ">
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person"></i>
                        <span>{{ auth()->user()->nom }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Tancar Sessió</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <div class="container">
        <section>
            @yield('contingut')
        </section>
    </div>

</body>


</html>
