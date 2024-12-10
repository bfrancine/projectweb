@extends('layouts.app')

@section('title', 'Tree History')

@section('breadcrumb')
    @if ($previousTitle === 'Dashboard')
        <x-breadcrumb :items="[['label' => 'Tree History']]" />
    @else
        <x-breadcrumb :items="[['label' => $previousTitle, 'previous' => true], ['label' => 'Tree History']]" />
    @endif
@endsection
@section('content')
    <!-- Contenedor principal con márgenes y padding -->
    <div class="container mx-auto px-4 py-8">
        <!-- Caja con fondo blanco, bordes redondeados y sombra -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">

            <!-- Encabezado con fondo degradado y título del historial del árbol -->
            <div class="bg-gradient-to-br from-green-950 to-emerald-950 text-white rounded-lg shadow-xl overflow-hidden">
                <!-- Encabezado del historial -->
                <x-tree-history.tree-header />

                <!-- Contenedor de estadísticas -->
                <div class="p-4 sm:p-6">
                    <!-- Grid para organizar las tarjetas de estadísticas -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6">

                        {{-- Tarjeta: Especie --}}
                        <x-tree-history.tree-stat-card 
                            label="Species" 
                            :value="$tree->species->commercial_name"
                            icon='<path fill="currentColor" stroke="currentColor" stroke-width=".5" d="..."/>' 
                        />

                        {{-- Tarjeta: Ubicación --}}
                        <x-tree-history.tree-stat-card 
                            label="Location" 
                            :value="$tree->location"
                            icon='<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="..."/>' 
                        />

                        {{-- Tarjeta: Tamaño actual --}}
                        <x-tree-history.tree-stat-card 
                            label="Current Size" 
                            :value="$tree->size . ' cm'"
                            icon='<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="..."/>' 
                        />

                        {{-- Tarjeta: Estado --}}
                        <x-tree-history.tree-stat-card 
                            label="Status" 
                            :value="ucfirst($tree->status)"
                            icon='<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="..."/>' 
                        />
                    </div>
                </div>
            </div>

            <!-- Línea de tiempo de actualizaciones -->
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-6">Growth Timeline</h2>

                @if ($updates->count() > 0)
                    <!-- Si hay actualizaciones, muestra una lista -->
                    <div class="space-y-8">
                        @foreach ($updates as $update)
                            <!-- Cada actualización se muestra en la línea de tiempo -->
                            <div class="relative pl-8 pb-8 border-l-2 border-green-200 last:pb-0">
                                <!-- Punto de la línea de tiempo -->
                                <div class="absolute -left-2 top-0 w-4 h-4 bg-green-600 rounded-full"></div>

                                <!-- Detalles de la actualización -->
                                <div class="bg-gray-50 rounded-lg shadow-sm p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Imagen de la actualización (si está disponible) -->
                                        <div>
                                            @if ($update->photo)
                                                <img src="{{ Storage::url($update->photo) }}" alt="Tree update"
                                                    class="rounded-lg w-full h-48 object-cover">
                                            @endif
                                        </div>
                                        <div class="space-y-3">
                                            <!-- Fecha de la actualización -->
                                            <div class="text-sm text-gray-500">
                                                {{ $update->created_at->format('F j, Y') }}
                                            </div>
                                            <!-- Tamaño del árbol en la actualización -->
                                            <div>
                                                <span class="font-semibold">Size:</span>
                                                {{ $update->size }} cm
                                            </div>
                                            <!-- Crecimiento desde la última actualización -->
                                            <div class="text-sm text-gray-500">
                                                Growth since last update:
                                                @if ($loop->index < count($updates) - 1)
                                                    {{ number_format($update->size - $updates[$loop->index + 1]->size, 2) }}
                                                    cm
                                                @else
                                                    First record
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Mensaje si no hay actualizaciones -->
                    <div class="text-center py-12 bg-gray-50 rounded-lg">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No updates yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new tree update.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
