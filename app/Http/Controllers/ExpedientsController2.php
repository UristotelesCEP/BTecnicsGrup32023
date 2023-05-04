<?php

namespace App\Http\Controllers;

use App\Models\Expedients;
use App\Models\Carta_trucades;
use App\Models\Estat_expedients;
use Illuminate\Http\Request;

class ExpedientsController extends Controller
{
    
    public function index()
    {
        $expedients = Expedients::with(['estatExpedient', 'cartesTrucades'])->get();
        return view('expedients', compact('expedients'));
    }

    public function show($id)
    {
        $expedient = Expedients::with('cartesTrucades')->findOrFail($id);

        return view('expedients.show', compact('expedient'));
    }

    public function create()
    {
        return view('expedients.create');
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

    public function update(Request $request, Expedients $expedient)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $expedient->update($request->all());

        return redirect()->route('expedients.index')
            ->with('success', 'Expedient updated successfully');
    }

    public function destroy(Expedients $expedient)
    {
        $expedient->delete();

        return redirect()->route('expedients.index')
            ->with('success', 'Expedient deleted successfully');
    }
}
