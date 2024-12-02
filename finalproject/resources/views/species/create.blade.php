@extends('layouts.app')

@section('title', 'Add New Species')

@section('content')
    <div class="container">
        <h1>Agregar Nueva Especie</h1>

        <!-- Mostrar mensaje de éxito si se ha añadido correctamente -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Formulario para agregar una nueva especie -->
        <form action="{{ route('species.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="commercial_name" class="form-label">Nombre Comercial:</label>
                <input type="text" id="commercial_name" name="commercial_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="scientific_name" class="form-label">Nombre Científico:</label>
                <input type="text" id="scientific_name" name="scientific_name" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Agregar Especie</button>
        </form>
    </div>
@endsection


