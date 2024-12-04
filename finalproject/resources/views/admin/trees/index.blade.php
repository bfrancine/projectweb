@extends('layouts.app')

@section('title', 'Manage Trees')

@section('breadcrumb')
    <x-breadcrumb :items="[['label' => 'Manage Trees']]" />
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Manage Trees</h1>
            <button onclick="document.getElementById('createTreeModal').classList.remove('hidden')"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Add New Tree
            </button>
        </div>

        <x-flash-alert />

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Species
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price
                        </th>
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($trees as $tree)
                        <tr data-tree-id="{{ $tree->id }}" data-species-id="{{ $tree->species_id }}"
                            data-location="{{ $tree->location }}" data-status="{{ $tree->status }}"
                            data-price="{{ $tree->price }}"
                            data-photo="{{ $tree->photo ? Storage::url($tree->photo) : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($tree->photo)
                                    <img src="{{ Storage::url($tree->photo) }}" alt="Tree"
                                        class="h-16 w-16 rounded object-cover">
                                @else
                                    <div class="h-16 w-16 rounded bg-gray-100 flex items-center justify-center">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $tree->species->commercial_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $tree->location }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $tree->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($tree->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">${{ number_format($tree->price, 2) }}</td>
                            <td class="px-6 py-4 text-center whitespace-nowrap text-sm space-x-3">
                                <button
                                    onclick="editTree( {{ $tree->id }},{{ $tree->species_id }},'{{ $tree->location }}',{{ $tree->size }},'{{ $tree->status }}', 
                                    {{ $tree->price }}, '{{ $tree->photo ? Storage::url($tree->photo) : '' }}')"
                                    class="inline-flex items-center px-3 py-2 border text-sm font-medium rounded-md border-emerald-600 text-emerald-700 hover:bg-emerald-50 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </button>
                                <!-- Add Delete Button -->
                                <form class="inline" method="POST" action="{{ route('trees.destroy', $tree) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this tree?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-2 border text-sm font-medium rounded-md border-red-50 text-red-700 bg-red-50 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('layouts.modal.tree.create-modal')
    @include('layouts.modal.tree.edit-modal')

    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function editTree(id, speciesId, location, size, status, price) {
            // Llenar el formulario
            document.getElementById('editTreeForm').action = `/trees/${id}`;
            document.getElementById('edit_species_id').value = speciesId;
            document.getElementById('edit_location').value = location;
            document.getElementById('edit_size').value = size;
            document.getElementById('edit_status').value = status;
            document.getElementById('edit_price').value = price;

            // Mostrar el modal
            document.getElementById('editTreeModal').classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>

@endsection
