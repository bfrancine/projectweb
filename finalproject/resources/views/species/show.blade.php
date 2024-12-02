@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalles de la Especie</h1>

        <div class="mb-3">
            <p><strong>Nombre Comercial:</strong> {{ $specie->commercial_name }}</p>
            <p><strong>Nombre Científico:</strong> {{ $specie->scientific_name }}</p>
        </div>

        <!-- Enlace para editar la especie -->
        <a href="{{ route('species.edit', $specie->id) }}" class="btn btn-warning mb-3">Editar</a>

        <!-- Formulario para eliminar la especie con confirmación -->
        <form action="{{ route('species.destroy', $specie->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta especie?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mb-3">Eliminar</button>
        </form>

        <!-- Enlace para volver a la lista de especies -->
        <a href="{{ route('species.index') }}" class="btn btn-secondary">Volver a la lista de especies</a>
    </div>
@endsection

