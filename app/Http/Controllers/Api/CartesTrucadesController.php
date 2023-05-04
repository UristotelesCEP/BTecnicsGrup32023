<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Support\Facades\Log;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cartes_trucades;
use App\Models\Expedients;

class CartesTrucadesController extends Controller
{

    //
    public function getExpedients(Request $request, $tel, $idMun, $incident)
{
    $expedients = Cartes_trucades::where('telefon', $tel)
                                 ->where('municipis_id', $idMun)
                                 ->where('incidents_id', $incident)
                                 ->get();
        
    return response()->json($expedients);
}

    public function store(Request $request)
    {
        try {
            $cartesTrucades = new Cartes_trucades;

            $cartesTrucades->codi_trucada = $request->codiTrucada;
            $cartesTrucades->data_hora_trucada = new \DateTime($request->iniciTrucada);
            $cartesTrucades->durada = $request->duracioTrucada;
            $cartesTrucades->interlocutors_id = $request->interlocutorID;
            $cartesTrucades->telefon = $request->numTel;
            $cartesTrucades->nom = $request->nom;
            $cartesTrucades->cognoms = $request->cognom;
            $cartesTrucades->nota_comuna = $request->notacomuna;
            $cartesTrucades->tipus_localitzacions_id = $request->tipusLocali;
            $cartesTrucades->decripcio_localitzacio = $request->descripcio;
            $cartesTrucades->detall_localitzacio = $request->detalls;
            $cartesTrucades->municipis_id = $request->selectedMunicipi;
            $cartesTrucades->provincies_id = $request->selectedProvincia;
            $cartesTrucades->incidents_id = $request->incident;
            $cartesTrucades->expedients_id = $request->expedient;
            $cartesTrucades->usuaris_id = $request->usuari;


            $cartesTrucades->save();

            return response()->json(['message' => 'Datos guardados con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al guardar los datos',
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ], 500);
        }
    }
}
