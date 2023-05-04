<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Municipi;

class MunicipiController extends Controller
{
    public function getMunicipis()
    {
        $municipis = Municipi::all();
        return response()->json($municipis);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $municipis = Municipi::all();
        return response()->json($municipis);
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
