@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Especie</h1>

        <!-- Formulario para editar la especie -->
        <form action="{{ route('species.update', $specie->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Especifica que se realizará una actualización (PUT) -->

            <div class="mb-3">
                <label for="commercial_name" class="form-label">Nombre Comercial:</label>
                <input type="text" name="commercial_name" id="commercial_name" class="form-control" value="{{ $specie->commercial_name }}" required>
            </div>

            <div class="mb-3">
                <label for="scientific_name" class="form-label">Nombre Científico:</label>
                <input type="text" name="scientific_name" id="scientific_name" class="form-control" value="{{ $specie->scientific_name }}">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Especie</button>
        </form>
    </div>
@endsection


