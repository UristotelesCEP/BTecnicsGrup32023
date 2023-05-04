@extends('plantilla.principal')

@section('titulo', 'Expedients')

@section('contingut')
<!-- tabla de expedientes -->
<table class="table">
    <thead>
      <tr>
        <th>Codi</th>
        <th>Estat</th>
        <th>Accions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($expedients as $expedient)
        <tr>
          <td>{{ $expedient->codi }}</td>
          <td>{{ $expedient->estat_expedients_id }}</td>
          <td>
            <!-- botón para mostrar las cartas de llamada del expediente -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cartasTrucadesModal{{ $expedient->id }}">
              Mostrar cartes trucades
            </button>

            <!-- modal con las cartas de llamada del expediente -->
            <div class="modal fade" id="cartasTrucadesModal{{ $expedient->id }}" tabindex="-1" aria-labelledby="cartasTrucadesModalLabel{{ $expedient->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="cartasTrucadesModalLabel{{ $expedient->id }}">Cartes Trucades - {{ $expedient->codi }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- tabla de cartas de llamada -->
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Codi trucada</th>
                          <th>Data hora trucada</th>
                          <th>Durada</th>
                          <th>Interlocutors</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($expedient->cartesTrucades as $carta)
                          <tr>
                            <td>{{ $carta->codi_trucada }}</td>
                            <td>{{ $carta->data_hora_trucada }}</td>
                            <td>{{ $carta->durada }}</td>
                            <td>{{ $carta->nom }} {{ $carta->cognoms }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

@endsection
