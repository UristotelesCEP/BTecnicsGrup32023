<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provincia;


class ProvinciaController extends Controller
{


    public function comarcas(Request $request, $id)
    {
        $provincia = Provincia::findOrFail($id);
        $comarcas = $provincia->comarcas;
        return response()->json($comarcas);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provincies = Provincia::all();
        return response()->json($provincies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
