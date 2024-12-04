@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr_2fr] lg:grid-cols-[1fr_1fr_1fr] gap-6 mb-8">
            <!-- Statistics -->
            <x-dashboard.stats-card title="My Trees" :value="$stats['my_trees']" icon="icons.tree" color="green" />

            <x-dashboard.stats-card title="Available Trees" :value="$stats['available_trees']" icon="icons.check-circle" color="blue" />

            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
                    <div class="flex flex-col xl:flex-row gap-4">
                        <a href="{{ route('friend.available-trees') }}"
                            class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100">
                            <span class="mr-3 text-blue-500">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M10.035,18.069a7.981,7.981,0,0,0,3.938-1.035l3.332,3.332a2.164,2.164,0,0,0,3.061-3.061l-3.332-3.332A8.032,8.032,0,0,0,4.354,4.354a8.034,8.034,0,0,0,5.681,13.715ZM5.768,5.768A6.033,6.033,0,1,1,4,10.035,5.989,5.989,0,0,1,5.768,5.768Z" />
                                </svg>
                            </span>
                            Find Available Trees
                        </a>

                        <a href="{{ route('friend.my-trees') }}"
                            class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100">
                            <span class="mr-3 text-green-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </span>
                            Show My Trees
                        </a>

                    </div>
                </div>
            </div>
        </div>



        <!-- Recent Trees -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-800">My Recent Trees</h2>
            </div>
            <div class="p-6">
                @if ($myTrees->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($myTrees as $tree)
                            <div class="bg-gray-50 rounded-lg p-4">
                                @if ($tree->photo)
                                    <img src="{{ Storage::url($tree->photo) }}" alt="Tree"
                                        class="w-full h-48 object-cover rounded-lg mb-4">
                                @endif
                                <h3 class="font-semibold text-lg mb-2">{{ $tree->species->commercial_name }}</h3>
                                <p class="text-gray-600 mb-2">Location: {{ $tree->location }}</p>
                                <p class="text-gray-600 mb-4">Size: {{ $tree->size }} cm</p>

                                <a href="{{ route('tree-history.index', ['tree' => $tree, 'from' => 'Dashboard']) }}"
                                    class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                    View History
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('friend.my-trees') }}" class="text-green-600 hover:text-green-700 font-semibold">
                            View all my trees →
                        </a>
                    </div>
                @else
                    <p class="text-gray-600">You don't have any trees yet.</p>
                    <div class="mt-4">
                        <a href="{{ route('friend.available-trees') }}"
                            class="inline-block bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                            Explore available trees
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
