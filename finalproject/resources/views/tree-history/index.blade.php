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
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">

            <div class="bg-gradient-to-br from-green-950 to-emerald-950 text-white rounded-lg shadow-xl overflow-hidden">
                <x-tree-history.tree-header />

                <div class="p-4 sm:p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6">
                        {{-- Species Card --}}
                        <x-tree-history.tree-stat-card label="Species" :value="$tree->species->commercial_name"
                            icon='<path fill="currentColor" stroke="currentColor" stroke-width=".5" d="M20.781 17.375l-2.7-3.375h.919c.373 0 .715-.207.887-.538.172-.331.146-.729-.068-1.035l-7-10c-.317-.452-.94-.562-1.393-.246-.091.063-.158.146-.221.231-.025.015-7.025 10.015-7.025 10.015-.214.306-.24.704-.068 1.035.173.331.515.538.888.538h.919l-2.7 3.375c-.24.301-.287.712-.121 1.059.167.345.518.566.902.566h7v3c0 .553.448 1 1 1s1-.447 1-1v-3h7c.384 0 .735-.221.901-.566.167-.347.12-.758-.12-1.059zm-7.781-.375v-5c0-.553-.448-1-1-1s-1 .447-1 1v5h-4.919l2.7-3.375c.24-.301.287-.712.121-1.059-.167-.345-.518-.566-.902-.566h-1.08l5.08-7.256 5.08 7.256h-1.08c-.384 0-.735.221-.901.566-.167.347-.12.758.121 1.059l2.7 3.375h-4.92z"/>' />

                        {{-- Location Card --}}
                        <x-tree-history.tree-stat-card label="Location" :value="$tree->location"
                            icon='<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>' />

                        {{-- Size Card with Growth Icon --}}
                        <x-tree-history.tree-stat-card label="Current Size" :value="$tree->size . ' cm'"
                            icon='<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19V5m0 0L7 9.5M12 5l5 4.5M3 20h18"/>' />

                        {{-- Status Card --}}
                        <x-tree-history.tree-stat-card label="Status" :value="ucfirst($tree->status)"
                            icon='<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>' />
                    </div>
                </div>
            </div>

            <!-- Updates Timeline -->
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-6">Growth Timeline</h2>

                @if ($updates->count() > 0)
                    <div class="space-y-8">
                        @foreach ($updates as $update)
                            <div class="relative pl-8 pb-8 border-l-2 border-green-200 last:pb-0">
                                <!-- Timeline Dot -->
                                <div class="absolute -left-2 top-0 w-4 h-4 bg-green-600 rounded-full"></div>

                                <div class="bg-gray-50 rounded-lg shadow-sm p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            @if ($update->photo)
                                                <img src="{{ Storage::url($update->photo) }}" alt="Tree update"
                                                    class="rounded-lg w-full h-48 object-cover">
                                            @endif
                                        </div>
                                        <div class="space-y-3">
                                            <div class="text-sm text-gray-500">
                                                {{ $update->created_at->format('F j, Y') }}
                                            </div>
                                            <div>
                                                <span class="font-semibold">Size:</span>
                                                {{ $update->size }} cm
                                            </div>
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
