<?php

namespace App\Http\Controllers;

use App\Models\Expedients;
use Illuminate\Http\Request;
use App\Models\Estat_expedients;
use Illuminate\Support\Facades\DB;
use App\Models\Cartes_trucades_has_agencies;
use App\Models\Agencies;
use App\Models\Cartes_Trucades;
use App\Models\Estat_agencies;

class ExpedientsController extends Controller
{
    public function index()
    {
        $expedients = Expedients::with(['cartesTrucades'])->get();
        $cartes_agencies = Cartes_trucades_has_agencies::with(['agencies'])->get();
        return view('expedients', compact('expedients', 'cartes_agencies'));
    }

    // public function index()
    // {
    //     $cartesTrucades = Cartes_Trucades::with(['expedients'])->get();
    //     $cartes_agencies = Cartes_trucades_has_agencies::with(['agencies'])->get();
    //     return view('expedients', compact('cartesTrucades', 'cartes_agencies'));
    // }
     

    public function show($id)
    {
        $expedient = Expedients::with('cartesTrucades')->findOrFail($id);

        return view('expedients.show', compact('expedient'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Expedients::create($request->all());

        return redirect()->route('expedients.index')
            ->with('success', 'Expedient created successfully.');
    }

    public function edit(Expedients $expedient)
    {
        return view('expedients.edit', compact('expedient'));
    }

    public function update(Request $request, $id)
    {
        $expedient = Expedients::find($id);
        if (!$expedient) {
            return response()->json(['message' => 'Expedient not found'], 404);
        }

        $newStatusId = $request->input('new_status');
        $estatExpedient = Estat_expedients::find($newStatusId);
        if (!$estatExpedient) {
            return response()->json(['message' => 'New status not found'], 404);
        }

        $expedient->estat_expedients_id = $newStatusId;
        $expedient->save();

        return $this->index();
    }

    public function agencies(Request $request, $cartes_trucades_id, $agencies_id)
    {
        $nuevoEstado = $request->input('nuevoEstado');
        $estatAgencia = Estat_agencies::find($nuevoEstado);
        
        if (!$estatAgencia) {
            return response()->json(['message' => 'New status not found'], 404);
        }

        Cartes_trucades_has_agencies::where('cartes_trucades_id', $cartes_trucades_id)->where('agencies_id', $agencies_id)->update(['estat_agencies_id' => $nuevoEstado]);

        return $this->index();
    }

    public function destroy(Expedients $expedient)
    {
        $expedient->delete();

        return redirect()->route('expedients.index')
            ->with('success', 'Expedient deleted successfully');
    }
}
