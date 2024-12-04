<?php

namespace App\Http\Controllers;

use App\Models\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    public function index()
    {
        $species = Species::all();
        return view('admin.species.index', compact('species'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'commercial_name' => 'required|string|max:255',
            'scientific_name' => 'required|string|max:255',
        ]);

        Species::create($validated);
        return redirect()->route('species.index')->with('success', 'Species created successfully');
    }

    public function update(Request $request, Species $species)
    {
        $validated = $request->validate([
            'commercial_name' => 'required|string|max:255',
            'scientific_name' => 'required|string|max:255',
        ]);

        $species->update($validated);
        return redirect()->route('species.index')->with('success', 'Species updated successfully');
    }

    public function destroy(Species $species)
    {
        $species->delete();
        return redirect()->route('species.index')->with('success', 'Species deleted successfully');
    }
}
