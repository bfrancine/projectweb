<?php

namespace App\Http\Controllers;

use App\Models\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    /**
     * Display a listing of all tree species
     * 
     * @return \Illuminate\View\View Returns view with list of all species
     */
    public function index()
    {
        $species = Species::all();
        return view('admin.species.index', compact('species'));
    }

    /**
     * Store a newly created tree species
     * 
     * @param \Illuminate\Http\Request $request The incoming request with tree species data:
     *                                         - commercial_name: name of the tree species
     *                                         - scientific_name: scientific classification
     * @return \Illuminate\Http\RedirectResponse Redirects to species list after successful creation
     * 
     * @throws \Illuminate\Validation\ValidationException When species data validation fails
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'commercial_name' => 'required|string|max:255',
            'scientific_name' => 'required|string|max:255',
        ]);

        Species::create($validated);
        return redirect()->route('species.index')->with('success', 'Species created successfully');
    }

    /**
     * Update an existing tree species information
     * 
     * @param \Illuminate\Http\Request $request The incoming request with updated tree data:
     *                                         - commercial_name: 
     *                                         - scientific_name: 
     * @param \App\Models\Species $species The tree species instance to be updated
     * @return \Illuminate\Http\RedirectResponse Redirects to species list after successful update
     * 
     * @throws \Illuminate\Validation\ValidationException When updated data validation fails
     */
    public function update(Request $request, Species $species)
    {
        $validated = $request->validate([
            'commercial_name' => 'required|string|max:255',
            'scientific_name' => 'required|string|max:255',
        ]);

        $species->update($validated);
        return redirect()->route('species.index')->with('success', 'Species updated successfully');
    }

    /**
     * Remove a tree species
     * 
     * @param \App\Models\Species $species The tree species instance to be deleted
     * @return \Illuminate\Http\RedirectResponse Redirects to species list after successful deletion
     */
    public function destroy(Species $species)
    {
        $species->delete();
        return redirect()->route('species.index')->with('success', 'Species deleted successfully');
    }
}
