<div id="editSpeciesModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="flex justify-center items-center min-h-screen">
        <div class="relative p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Species</h3>
            <form id="editSpeciesForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_commercial_name">
                        Commercial Name
                    </label>
                    <input type="text" name="commercial_name" id="edit_commercial_name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_scientific_name">
                        Scientific Name
                    </label>
                    <input type="text" name="scientific_name" id="edit_scientific_name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="document.getElementById('editSpeciesModal').classList.add('hidden')"
                        class="bg-white text-gray-700 px-3 sm:px-4 py-2 text-sm sm:text-base rounded-lg border border-gray-300 hover:bg-gray-50 mr-2">
                        Cancel
                    </button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
