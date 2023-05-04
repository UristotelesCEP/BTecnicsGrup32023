<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INICI</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/app.scss'])

</head>

<body>
    <div class="container-fluid h-100 d-flex flex-column justify-content-center align-items-center">
        <div class="row w-100 mb-1">
            <div class="d-flex justify-content-end mt-4">
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



        <div class="row justify-content-center align-items-center flex-grow-1">
            <div class="col-12 col-md-8 col-lg-6 text-center mb-2">
                <img src="img/Logo.png" class="image">
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">


                <div class="col text-center">
                    <a href="{{ route('cartaTrucada') }}">
                        <img class="img-fluid ico bg-success" src="img/Ico3.svg" alt="">
                        <h6>INICIAR TRUCADA</h6>
                    </a>
                </div>



                <div class="col text-center">
                    <a href="{{ route('expedients.index') }}">

                        <img class="img-fluid ico bg-primary" src="img/Ico2.svg" alt="">
                        <h6>GESTIONAR EXPEDIENTS</h6>
                    </a>
                </div>



                <div class="col text-center">

                    <img class="img-fluid ico bg-warning" src="img/Ico6.svg" alt="">
                    <h6>VIDEO INTERACTIU</h6>

                </div>

                <div class="col text-center">

                    <img class="img-fluid ico bg-danger" src="img/Ico4.svg" alt="">
                    <h6>GESTIONAR TRUCADES</h6>

                </div>

                <div class="col text-center">

                    <img class="img-fluid ico bg-secondary" src="img/Ico5.svg" alt="">
                    <h6>OBSERVAR GRAFICS</h6>

                </div>

                @if (auth()->user()->tipus_usuaris_id === 3)

                <div class="col text-center">
                    <a href="{{ route('gestioUsuaris') }}">
                        <img class="img-fluid ico bg-info" src="img/Ico7.svg" alt="">
                        <h6>GESTIONAR USUARIS</h6>
                    </a>
                </div>

                @endif
            </div>
        </div>
    </div>
</body>



</html>