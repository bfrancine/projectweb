<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use App\Http\Requests\StoreSpecieRequest;
use App\Http\Requests\UpdateSpecieRequest;

class SpecieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          // Devuelve todas las especies
          return Specie::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecieRequest $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'commercial_name' => 'required|string|max:255',
            'scientific_name' => 'required|string|max:255',
        ]);

        // Crear una nueva especie
        $specie = Specie::create($validatedData);

        // Retornar la especie creada con un código de estado HTTP 201 (creado)
        return response()->json($specie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Specie $specie)
    {
       // Mostrar una especie específica por su ID
       return response()->json($specie);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specie $specie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecieRequest $request, Specie $specie)
    {
         // Validar los datos de entrada
         $validatedData = $request->validate([
            'commercial_name' => 'required|string|max:255',
            'scientific_name' => 'required|string|max:255',
        ]);

        // Actualizar la especie con los nuevos datos
        $specie->update($validatedData);

        // Retornar la especie actualizada
        return response()->json($specie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specie $specie)
    {
               // Eliminar la especie
               $specie->delete();

               // Retornar una respuesta de éxito
               return response()->json(null, 204);

    }
}
