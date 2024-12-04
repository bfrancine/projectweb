@extends('layouts.app')

@section('title', 'Manage Species')

@section('breadcrumb')
    <x-breadcrumb :items="[['label' => 'Manage Species']]" />
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Manage Species</h1>
            <button onclick="document.getElementById('createSpeciesModal').classList.remove('hidden')"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Add New Species
            </button>
        </div>

        <x-flash-alert />

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Commercial Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Scientific Name
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($species as $specie)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $specie->commercial_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $specie->scientific_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                <button
                                    onclick="editSpecies({{ $specie->id }}, '{{ $specie->commercial_name }}', '{{ $specie->scientific_name }}')"
                                    class="inline-flex items-center px-3 py-2 border text-sm font-medium rounded-md 
                                    border-emerald-600 text-emerald-700 hover:bg-emerald-50 transition-colors duration-200 mr-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit Specie
                                </button>

                                <form action="{{ route('species.destroy', $specie) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this specie?')"
                                        class="inline-flex items-center px-3 py-2 border text-sm font-medium rounded-md 
                                        border-red-50 text-red-700 bg-red-50 transition-colors duration-200">
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

    @include('layouts.modal.species.create-modal')
    @include('layouts.modal.species.edit-modal')

    <script>
        function editSpecies(id, commercialName, scientificName) {
            document.getElementById('edit_commercial_name').value = commercialName;
            document.getElementById('edit_scientific_name').value = scientificName;
            document.getElementById('editSpeciesForm').action = `/species/${id}`;
            document.getElementById('editSpeciesModal').classList.remove('hidden');
        }
    </script>
@endsection
