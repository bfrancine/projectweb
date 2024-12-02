@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Todas las Especies</h1>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Enlace para agregar una nueva especie -->
        <a href="{{ route('species.create') }}" class="btn btn-primary mb-3">Agregar Nueva Especie</a>

        <ul class="list-group">
            <!-- Bucle a través de las especies -->
            @foreach($species as $specie)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <!-- Mostrar el nombre comercial de la especie -->
                    {{ $specie->commercial_name }}

                    <div>
                        <!-- Enlace para ver la especie -->
                        <a href="{{ route('species.show', $specie->id) }}" class="btn btn-info btn-sm">Ver</a>

                        <!-- Enlace para editar la especie -->
                        <a href="{{ route('species.edit', $specie->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Formulario para eliminar la especie -->
                        <form action="{{ route('species.destroy', $specie->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta especie?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
