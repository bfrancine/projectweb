<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use App\Http\Requests\StoreSpecieRequest;
use App\Http\Requests\UpdateSpecieRequest;
use Illuminate\Http\Request;

class SpecieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Specie::all();  // Devuelve todas las especies
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Si usas formularios para crear, puedes devolver una vista de creación aquí
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecieRequest $request)
    {
        // Validar y crear una nueva especie
        $validatedData = $request->validate([
            'commercial_name' => 'required|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
        ]);

        // Crear la nueva especie
        $specie = Specie::create($validatedData);

        // Retorna la especie creada con un código de estado HTTP 201 (creado)
        return response()->json($specie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Specie $specie)
    {
        // Muestra una especie específica por su ID
        return response()->json($specie);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specie $specie)
    {
        // Generalmente no se usa en RESTful APIs
        // En su lugar, la actualización se maneja directamente en la acción update()
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecieRequest $request, Specie $specie)
    {
        // Valida los datos de entrada
        $validatedData = $request->validate([
            'commercial_name' => 'required|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
        ]);

        // Actualiza la especie con los nuevos datos
        $specie->update($validatedData);

        // Retorna la especie actualizada
        return response()->json($specie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specie $specie)
    {
        // Elimina la especie
        $specie->delete();

        // Retorna una respuesta de éxito sin contenido
        return response()->json(null, 204);  // 204 No Content
    }
}

