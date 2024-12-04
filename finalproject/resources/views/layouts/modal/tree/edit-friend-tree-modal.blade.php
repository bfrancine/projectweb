<div id="editTreeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="flex justify-center items-center min-h-screen">
        <div class="relative p-5 border w-96 shadow-lg rounded-md bg-white">
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
                            class="bg-white text-gray-700 px-3 sm:px-4 py-2 text-sm sm:text-base rounded-lg border border-gray-300 hover:bg-gray-50 mr-2">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Update Tree
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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
</script>
