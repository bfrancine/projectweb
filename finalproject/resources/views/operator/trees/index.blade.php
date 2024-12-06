@extends('layouts.app')

@section('title', 'Manage History Trees')

@section('breadcrumb')
    <x-breadcrumb :items="[['label' => 'Manage History Trees']]" />
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Species</th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Owner</th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Current Size</th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($trees as $tree)
                                <tr>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span class="text-sm font-medium text-gray-900">#{{ $tree->id }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span
                                            class="ml-3 text-sm text-gray-900">{{ $tree->species->commercial_name }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span class="ml-3 text-sm text-gray-900">
                                            {{ $tree->owner->first_name . ' ' . $tree->owner->last_name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="text-sm">
                                            <span class="font-medium text-gray-900">{{ $tree->size }}</span>
                                            <span class="text-gray-500">cm</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap space-x-2">
                                        <button onclick="openUpdateModal({{ $tree->id }}, {{ $tree->size }})"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md
                                            text-white bg-emerald-600 hover:bg-emerald-700 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Record Update
                                        </button>
                                        <a href="{{ route('tree-history.index', ['tree' => $tree, 'from' => 'Manage History Trees']) }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md
                                            text-emerald-700 bg-emerald-100 hover:bg-emerald-200 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            View History
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="rounded-full bg-gray-100 p-3 mb-4">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                                </svg>
                                            </div>
                                            <p class="text-gray-500 text-sm">No purchased trees found</p>
                                            <p class="text-gray-400 text-xs mt-1">Trees will appear here once purchased</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Update Modal -->
        @include('layouts.modal.tree-history.update-tree-modal') 
    </div>

@endsection
