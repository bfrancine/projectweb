@extends('layouts.app')

@section('title', 'Friend Trees Management')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Friend Info Header -->
        <div class="mb-6">
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-full bg-green-500 flex items-center justify-center">
                            <span class="text-xl font-medium text-white">
                                {{ strtoupper(substr($friend->first_name, 0, 1)) }}
                            </span>
                        </div>
                        <div class="ml-4">
                            <h1 class="text-2xl font-bold text-gray-800">{{ $friend->first_name }} {{ $friend->last_name }}'s
                                Trees</h1>
                            <p class="text-gray-600">{{ $friend->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Species
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Current Size
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($trees as $tree)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $tree->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $tree->species->commercial_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $tree->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ ucfirst($tree->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $tree->size }} cm
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                        <button onclick="openEditTreeModal({{ $tree->id }}, {{ json_encode($tree) }})"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            Edit Tree
                                        </button>
                                        <button onclick="openUpdateModal({{ $tree->id }}, {{ $tree->size }})"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                            Record Update
                                        </button>
                                        <a href="{{ route('tree-updates.history', $tree) }}"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200">
                                            View History
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No trees found for this friend
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Edit Tree Modal -->
        <div id="editTreeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Tree Information</h3>
                    <form id="editTreeForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Size (cm)</label>
                                <input type="number" name="size" id="editSize" step="0.1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Species</label>
                                <select name="species_id" id="editSpecies"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    @foreach ($species as $specie)
                                        <option value="{{ $specie->id }}">{{ $specie->commercial_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Location</label>
                                <textarea name="location" id="editLocation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                    rows="3" required></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="editStatus"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <option value="available">Available</option>
                                    <option value="sold">Sold</option>
                                </select>
                            </div>

                            <div class="flex justify-end space-x-3 mt-4">
                                <button type="button" onclick="closeEditTreeModal()"
                                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                    Update Tree
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Update Modal -->
        <div id="updateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Record Tree Update</h3>
                    <form id="updateForm" action="" method="POST" enctype="multipart/form-data"
                        onsubmit="return validateSize()">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Size (cm)</label>
                                <input type="number" name="size" id="sizeInput" step="0.1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <p id="sizeError" class="mt-1 text-sm text-red-600 hidden">The new size must be greater than
                                    the current size</p>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="photo">Photo</label>
                                <div
                                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <img id="imagePreview" class="mx-auto h-32 w-32 object-cover rounded-lg hidden" />
                                        <div class="flex text-sm text-gray-600">
                                            <label for="photo"
                                                class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                                <span>Upload a file</span>
                                                <input type="file" name="photo" id="photo" required
                                                    accept="image/*" class="sr-only" onchange="previewImage(this)">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-3 mt-4">
                                <button type="button" onclick="closeUpdateModal()"
                                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                    Save Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentTreeSize = 0;

        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function openEditTreeModal(treeId, tree) {
            const modal = document.getElementById('editTreeModal');
            const form = document.getElementById('editTreeForm');

            // Set form action
            form.action = `/admin/friends/{{ $friend->id }}/trees/${treeId}`;

            // Fill form fields
            document.getElementById('editSize').value = tree.size;
            document.getElementById('editSpecies').value = tree.species_id;
            document.getElementById('editLocation').value = tree.location;
            document.getElementById('editStatus').value = tree.status;

            modal.classList.remove('hidden');
        }

        function closeEditTreeModal() {
            const modal = document.getElementById('editTreeModal');
            modal.classList.add('hidden');
        }

        function openUpdateModal(treeId, currentSize) {
            const modal = document.getElementById('updateModal');
            const form = document.getElementById('updateForm');
            const sizeInput = document.getElementById('sizeInput');

            currentTreeSize = currentSize;
            form.action = `/admin/tree-updates/${treeId}`;
            sizeInput.value = currentSize;
            sizeInput.min = currentSize;
            modal.classList.remove('hidden');

            // Reset image preview
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.classList.add('hidden');
            imagePreview.src = '';

            document.getElementById('sizeError').classList.add('hidden');
        }

        function validateSize() {
            const sizeInput = document.getElementById('sizeInput');
            const errorElement = document.getElementById('sizeError');

            if (parseFloat(sizeInput.value) <= currentTreeSize) {
                errorElement.classList.remove('hidden');
                return false;
            }

            errorElement.classList.add('hidden');
            return true;
        }

        function closeUpdateModal() {
            const modal = document.getElementById('updateModal');
            modal.classList.add('hidden');
        }
    </script>
@endsection
