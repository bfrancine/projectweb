@extends('layouts.app')

@section('title', 'My Trees')

@section('breadcrumb')
    <x-breadcrumb :items="[['label' => 'My Trees']]" />
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-800">My Trees</h2>
            </div>
            <div class="p-6">
                @if ($trees->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($trees as $tree)
                            <div class="bg-gray-50 rounded-lg p-4">
                                @if ($tree->photo)
                                    <img src="{{ Storage::url($tree->photo) }}" alt="Tree"
                                        class="w-full h-48 object-cover rounded-lg mb-4">
                                @endif
                                <h3 class="font-semibold text-lg mb-2">{{ $tree->species->commercial_name }}</h3>
                                <div class="text-sm text-gray-500 mb-1">Scientific Name:
                                    {{ $tree->species->scientific_name }}</div>
                                <p class="text-gray-600 mb-2">Location: {{ $tree->location }}</p>
                                <p class="text-gray-600 mb-4">Size: {{ $tree->size }} cm</p>
                                <div class="flex justify-between items-center">
                                    <a href="{{ route('tree-history.index', ['tree' => $tree, 'from' => 'My Trees']) }}"
                                        class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                        View History
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">You don't have any trees yet.</p>
                    <div class="mt-4">
                        <a href="{{ route('friend.available-trees') }}"
                            class="inline-block bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                            Browse available trees
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
