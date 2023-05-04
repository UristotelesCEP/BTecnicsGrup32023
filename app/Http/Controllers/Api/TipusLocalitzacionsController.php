<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipusLocalitzacio;

class TipusLocalitzacionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipusLocalitzacions = TipusLocalitzacio::all();
        return response()->json($tipusLocalitzacions, 200);
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
