@extends('plantilla.principal')

@section('titulo', 'Expedients')

@section('contingut')


@vite(['resources/js/filtrarexpedients.js'])

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
<!-- tabla de expedientes -->
<div class="card mt-4">
  <div class="card-header">
    <h3>Expedients</h3>
  </div>
  <div class="card-body">
    <div class="mb-3">
      <form id="filter-form" class="form-inline">
        <div class="form-group mr-5">
          <label for="estat-filter" class="mr-2">Filtrar per Estat:</label>
          <input type="text" id="estat-filter" name="estat-filter" class="form-control">
        </div>
        <div class="form-group mr-5">
          <label for="codi-filter" class="mr-2">Filtrar per Codi:</label>
          <input type="text" id="codi-filter" name="codi-filter" class="form-control">
        </div>
      </form>
    </div>
    <table class="table" id="tablita">
      <thead>
        <tr>
          <th class="col-3 text-center">Estat</th>
          <th class="col-5 text-center">Codi</th>
          <th class="text-center">Accions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($expedients as $expedient)
        <tr>
          <td class="col-3 text-center" id="{{ $expedient->estat_expedients_id }}"><span @if($expedient->estat_expedients_id == 1)class="badge text-bg-primary" @elseif($expedient->estat_expedients_id == 2)class="badge text-bg-primary" @elseif($expedient->estat_expedients_id == 3)class="badge text-bg-primary" @elseif($expedient->estat_expedients_id == 4)class="badge text-bg-primary" @elseif($expedient->estat_expedients_id == 5)class="badge text-bg-primary" @endif >@if($expedient->estat_expedients_id == 1)En procés @elseif($expedient->estat_expedients_id == 2)Sol·licitat @elseif($expedient->estat_expedients_id == 3)Acceptat @elseif($expedient->estat_expedients_id == 4)Tancat @elseif($expedient->estat_expedients_id == 5)Immobilitzat @endif</span></td>
          <td class="col-5 text-center">{{ $expedient->codi }}</td>
          <td class="text-center">
            <!-- botón para mostrar las cartas de llamada del expediente -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cartasTrucadesModal{{ $expedient->id }}">
              Mostrar cartes trucades
            </button>

            <!-- modal con las cartas de llamada del expediente -->
            <div class="modal fade" id="cartasTrucadesModal{{ $expedient->id }}" tabindex="-1" role="dialog" aria-labelledby="cartasTrucadesModalLabel{{ $expedient->id }}" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="cartasTrucadesModalLabel{{ $expedient->id }}">Cartes Trucades - {{ $expedient->codi }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Codi Trucada</th>
                          <th>Codi Expedient</th>
                          <th>Telefon</th>
                          <th>Data i Hora</th>
                          <th>Dades trucada</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($expedient->cartesTrucades as $carta)
                        <tr>
                          <td>{{ $carta->codi_trucada }}</td>
                          <td>{{ $expedient->codi }}</td>
                          <td>{{ $carta->telefon }}</td>
                          <td>{{ $carta->data_hora_trucada }}</td>
                          <td>
                            <button id="botonsito" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cartasTrucadesModal2{{ $carta->id }}"><i class="fas fa-folder"></i>
                            </button>

                            <div class="modal fade" id="cartasTrucadesModal2{{ $carta->id }}" tabindex="-1" role="dialog" aria-labelledby="cartasTrucadesModal2{{ $carta->id }}" aria-hidden="true" @if(isset($openSecondModal) && $openSecondModal && $loop->first) style="display:block" @endif>
                              <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="cartasTrucadesModal2Label{{ $carta->id }}">Cartes Trucades - {{ $expedient->codi }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="container-fluid">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div id="section1">
                                            <h5>Identificació de la trucada</h5>
                                            <div class="form-group">
                                              <label for="codi">Codi</label>
                                              <input type="text" class="form-control" id="codi" name="codi" value="{{ $carta->codi_trucada }}" disabled>
                                            </div>
                                            <div class="form-group">
                                              <label for="telefon">Número de telèfon</label>
                                              <input type="text" class="form-control" id="telefon" name="telefon" value="{{ $carta->telefon }}" disabled>
                                            </div>
                                            <div class="form-group">
                                              <label for="adreca">Adreça</label>
                                              <input type="text" class="form-control" id="adreca" name="adreca" value="{{ $carta->descripcio_localitzacio }}" disabled>
                                            </div>
                                            <div class="form-group">
                                              <label for="municipi">Municipi</label>
                                              <input type="text" class="form-control" id="municipi" name="municipi" value="{{ $carta->municipis_id }}" disabled>
                                            </div>
                                            <div class="form-group">
                                              <label for="comarca">Comarca</label>
                                              <input type="text" class="form-control" id="comarca" name="comarca" value="{{ $carta->provincia_id }}" disabled>
                                            </div>
                                          </div>
                                          <div id="section2">
                                            <h5>Nota comuna</h5>
                                            <!-- Aquí va el cuadro de texto de la sección 2 -->
                                          </div>
                                          <div id="section3">
                                            <h5>Localització de l'emergència</h5>
                                            <div class="form-group">
                                              <label for="adreca">Adreça</label>
                                              <input type="text" class="form-control" id="adreca" name="adreca" value="{{ $carta->descripcio_localitzacio }}" disabled>
                                            </div>
                                            <div class="form-group">
                                              <label for="municipi">Municipi</label>
                                              <input type="text" class="form-control" id="municipi" name="municipi" value="{{ $carta->municipis_id }}" disabled>
                                            </div>
                                            <div class="form-group">
                                              <label for="comarca">Comarca</label>
                                              <input type="text" class="form-control" id="comarca" name="comarca" value="{{ $carta->provincies_id }}" disabled>
                                            </div>
                                          </div>
                                          <div id="section4">
                                            <h5>Tipificació de l'emergència</h5>
                                            <!-- Aquí van los campos de la sección 4 -->
                                          </div>
                                          <div id="section5">
                                            <h5>Agencies</h5>
                                            @foreach($cartes_agencies as $carta_agencia)
                                            @if($carta_agencia->cartes_trucades_id == $carta->id)
                                            <form method="POST" id="select2" action="{{ route('ExpedientsController.agencies', [$carta_agencia->cartes_trucades_id, $carta_agencia->agencies_id]) }}" class="d-flex justify-content-start align-items-center w-100">
                                              @csrf
                                              @method('PUT')
                                              <label for="nuevoEstado">@if($carta_agencia->agencies_id == $carta_agencia->agencies->id) {{ $carta_agencia->agencies->nom }} @endif</label>
                                              <select class="form-select" name="nuevoEstado" id="nuevoEstado">
                                                <option value="1" @if ($carta_agencia->estat_agencies_id == 1) selected @endif>Contactat</option>
                                                <option value="2" @if ($carta_agencia->estat_agencies_id == 2) selected @endif>En procés</option>
                                                <option value="3" @if ($carta_agencia->estat_agencies_id == 3) selected @endif>Finalitzat</option>
                                              </select>
                                              <button type="submit" class="btn btn-primary ml-2" style="white-space: nowrap;">Guardar estat</button>
                                              <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Tancar</button>
                                            </form>
                                            @endif
                                            @endforeach
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <form method="POST" id="choose" action="{{ route('ExpedientsController.update', $expedient->id) }}" class="d-flex justify-content-start align-items-center w-100">
                      @csrf
                      @method('PUT')
                      <select class="form-select" name="new_status" id="new_status">
                        <option value="1" @if ($expedient->estat_expedients_id == 1) selected @endif>En procés</option>
                        <option value="2" @if ($expedient->estat_expedients_id == 2) selected @endif>Sol·licitat</option>
                        <option value="3" @if ($expedient->estat_expedients_id == 3) selected @endif>Acceptat</option>
                        <option value="4" @if ($expedient->estat_expedients_id == 4) selected @endif>Tancat</option>
                        <option value="5" @if ($expedient->estat_expedients_id == 5) selected @endif>Immobilitzat</option>
                      </select>
                      <button type="submit" class="btn btn-primary ml-5" style="white-space: nowrap;">Guardar estat</button>
                      <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Tancar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


@endsection