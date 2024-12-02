<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use Illuminate\Http\Request;

class SpecieController extends Controller
{
    // Muestra todas las especies
    public function index()
    {
        $species = Specie::all();  // Obtiene todas las especies de la base de datos
        return view('species.index', compact('species'));  // Retorna la vista con las especies
    }

    // Muestra los detalles de una especie
    public function show($id)
    {
        $specie = Specie::findOrFail($id);  // Encuentra la especie por ID o lanza un error 404
        return view('species.show', compact('specie'));  // Muestra la vista con los detalles de la especie
    }

    // Muestra el formulario para agregar una nueva especie
    public function create()
    {
        return view('species.create');  // Retorna la vista para agregar una nueva especie
    }

    // Almacena una nueva especie en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'commercial_name' => 'required|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
        ]);

        // Crear la nueva especie
        Specie::create($validatedData);

        // Redirigir con mensaje de éxito
        return redirect()->route('species.index')->with('success', 'Specie added successfully!');
    }

    // Muestra el formulario para editar una especie existente
    public function edit($id)
    {
        $specie = Specie::findOrFail($id);  // Encuentra la especie por ID
        return view('species.edit', compact('specie'));  // Muestra la vista para editar
    }

    // Actualiza una especie existente
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'commercial_name' => 'required|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
        ]);

        // Encuentra la especie por ID y actualiza los datos
        $specie = Specie::findOrFail($id);
        $specie->update($validatedData);

        // Redirigir con mensaje de éxito
        return redirect()->route('species.index')->with('success', 'Specie updated successfully!');
    }

    
    // Elimina una especie de la base de datos
    public function destroy($id)
    {
        $specie = Specie::findOrFail($id);  // Encuentra la especie por ID o lanza un error 404
        $specie->delete();  // Elimina la especie
        return redirect()->route('species.index')->with('success', 'Specie deleted successfully!');
    }
}

