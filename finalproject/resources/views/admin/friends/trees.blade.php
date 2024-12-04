@extends('layouts.app')

@section('title', 'Friend Trees Management')

@section('breadcrumb')
    <x-breadcrumb :items="[['label' => 'Manage Friends', 'route' => 'friends.index'], ['label' => 'Manage Trees']]" />
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Friend Info Header -->
        <div class="mb-6">
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-full bg-green-700 flex items-center justify-center">
                            <span class="text-xl font-medium text-white">
                                {{ strtoupper(substr($friend->first_name, 0, 1)) }}
                            </span>
                        </div>
                        <div class="ml-4">
                            <h1 class="text-2xl font-bold text-gray-800">{{ $friend->first_name }}
                                {{ $friend->last_name }}'s
                                Trees</h1>
                            <p class="text-gray-600">{{ $friend->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Species</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Current Size</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($trees as $tree)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        #{{ $tree->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $tree->species->commercial_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-3 py-1 inline-flex text-sm leading-5 font-medium rounded-full 
                                            {{ $tree->status === 'available' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ ucfirst($tree->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="font-medium">{{ $tree->size }}</span>
                                        <span class="text-gray-500">cm</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                        <button onclick="openEditTreeModal({{ $tree->id }}, {{ json_encode($tree) }})"
                                            class="inline-flex items-center px-3 py-2 border text-sm font-medium rounded-md 
                                            border-emerald-600 text-emerald-700 hover:bg-emerald-50 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit Tree
                                        </button>
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
                                        <a href="{{ route('tree-history.index', ['tree' => $tree, 'from' => 'My Trees']) }}"
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
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                            </svg>
                                            <p class="text-gray-600">No trees found for this friend</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Edit Friend Tree Modal -->
        @include('layouts.modal.tree.edit-friend-tree-modal')

        <!-- Update Modal -->
        @include('layouts.modal.tree-history.update-tree-modal')
    </div>

@endsection
