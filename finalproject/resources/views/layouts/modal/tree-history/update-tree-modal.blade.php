<div id="updateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="flex justify-center items-center min-h-screen">
        <div class="relative p-5 border w-96 shadow-lg rounded-md bg-white">
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
                                        <input type="file" name="photo" id="photo" required accept="image/*"
                                            class="sr-only" onchange="previewImage(this)">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-4">
                        <button type="button" onclick="closeUpdateModal()"
                            class="bg-white text-gray-700 px-3 sm:px-4 py-2 text-sm sm:text-base rounded-lg border border-gray-300 hover:bg-gray-50 mr-2">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lj hover:bg-green-700">
                            Save Update
                        </button>
                    </div>
                </div>
            </form>
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
