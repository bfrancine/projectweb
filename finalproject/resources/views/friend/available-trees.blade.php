@extends('layouts.app')

@section('title', 'Available Trees')

@section('breadcrumb')
    <x-breadcrumb :items="[['label' => 'Available Trees']]" />
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <x-flash-alert />

        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Available Trees</h2>
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
                                <p class="text-gray-600 mb-2">Location: {{ $tree->location }}</p>
                                <p class="text-gray-600 mb-2">Size: {{ $tree->size }} cm</p>
                                <p class="text-lg font-bold text-green-600 mb-4">${{ number_format($tree->price, 2) }}</p>

                                <button
                                    onclick="openPurchaseModal('{{ $tree->id }}', '{{ $tree->species->commercial_name }}', {{ $tree->price }})"
                                    class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                    Purchase Tree
                                </button>

                                <a href="{{ route('tree-history.index', ['tree' => $tree, 'from' => 'Available Trees']) }}"
                                    class="block text-center mt-2 text-green-600 hover:text-green-700">
                                    View more details
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">No trees available at the moment.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Purchase Modal -->
    @include('layouts.modal.purchase.purchase-modal')
@endsection
