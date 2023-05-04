<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tipus_incidents;
use App\Models\Incidents;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function index()
    {
        $tipusIncidents = Tipus_incidents::all();
        return response()->json($tipusIncidents);
    }

    public function show($id)
    {
        $tipusIncident = Tipus_incidents::with('incidents')->find($id);

        if (!$tipusIncident) {
            return response()->json(['error' => 'Tipus d\'incident no trobat'], 404);
        }

        return response()->json($tipusIncident->incidents);
    }
}
