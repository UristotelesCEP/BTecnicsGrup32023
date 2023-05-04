@extends('plantilla.principal')

@section('titulo', 'CARTATRUCADA')

@section('contingut')

    <script>
        window.userId = {{ auth()->id() }};
    </script>
    <div id="app">

    </div>

@endsection
