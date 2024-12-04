<div id="createTreeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="flex justify-center items-center min-h-screen">
        <div class="relative p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Tree</h3>
            <form action="{{ route('trees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="species_id">Species</label>
                        <select name="species_id" id="species_id" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @foreach ($species as $specie)
                                <option value="{{ $specie->id }}">{{ $specie->commercial_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="location">Location</label>
                        <input type="text" name="location" id="location" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="size">Size (cm)</label>
                        <input type="number" step="0.01" min="0" name="size" id="size" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Price</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-600">$</span>
                            <input type="number" step="1" min="1" name="price" id="price" required
                                class="shadow appearance-none border rounded w-full py-2 pl-8 pr-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="photo">Photo</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <img id="createImagePreview" class="mx-auto h-32 w-32 object-cover rounded-lg hidden" />
                                <div class="flex text-sm text-gray-600">
                                    <label for="photo"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                        <span>Upload a file</span>
                                        <input type="file" name="photo" id="photo" required accept="image/*"
                                            class="sr-only" onchange="previewImage(this, 'createImagePreview')">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal('createTreeModal')"
                            class="bg-white text-gray-700 px-3 sm:px-4 py-2 text-sm sm:text-base rounded-lg border border-gray-300 hover:bg-gray-50 mr-2">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Save Tree
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
