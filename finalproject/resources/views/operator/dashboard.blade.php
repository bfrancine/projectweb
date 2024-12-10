@extends('layouts.app')

@section('title', 'Operator Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Operator Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Statistics Cards -->
            <x-dashboard.stats-card title="Registered Friends" :value="$stats['friends_count']" icon="icons.users" color="purple" />

            <x-dashboard.stats-card title="Available Trees" :value="$stats['available_trees']" icon="icons.tree" color="green" />
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
                    <div class="space-y-4">
                        <a href="{{ route('operator.trees.list') }}"
                            class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100">
                            <span class="mr-3 text-green-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </span>
                            Manage History Trees
                        </a>

                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4">Recent Updates</h2>
                    <div class="space-y-4">
                        @forelse ($recentUpdates ?? [] as $update)
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-600">
                                    Updated tree for
                                    {{ $update->tree?->owner?->first_name . ' ' . $update->tree?->owner?->last_name ?? 'Unknown Owner' }}
                                    size: {{ $update->size }} cm
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $update->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @empty
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-600">No recent tree updates</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endsection
