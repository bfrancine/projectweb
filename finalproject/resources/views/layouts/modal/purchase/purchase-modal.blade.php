<div id="purchaseModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="flex justify-center items-center min-h-screen">
        <div class="relative p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Purchase Tree</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tree Species</label>
                    <input type="text" id="modalTreeSpecies" class="w-full px-3 py-2 border rounded-md bg-gray-50"
                        readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                    <input type="text" id="modalTreePrice" class="w-full px-3 py-2 border rounded-md bg-gray-50"
                        readonly>
                </div>

                @foreach ($trees as $tree)
                    <form id="purchaseForm{{ $tree->id }}" action="{{ route('friend.purchases.store', $tree) }}"
                        method="POST" class="hidden">
                        @csrf
                    </form>
                @endforeach

                <div class="flex space-x-4">
                    <button type="button" onclick="closePurchaseModal()"
                        class="bg-white text-gray-700 px-3 sm:px-4 py-2 text-sm sm:text-base rounded-lg border border-gray-300 hover:bg-gray-50 mr-2">
                        Cancel
                    </button>
                    <button id="confirmPurchaseButton" onclick="submitPurchaseForm()"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg">
                        Confirm Purchase
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentTreeId = null;

    function openPurchaseModal(treeId, species, price) {
        currentTreeId = treeId;
        document.getElementById('modalTreeSpecies').value = species;
        document.getElementById('modalTreePrice').value = '$' + price.toLocaleString(undefined, {
            minimumFractionDigits: 2
        });
        document.getElementById('purchaseModal').classList.remove('hidden');
    }

    function submitPurchaseForm() {
        if (currentTreeId) {
            document.getElementById('purchaseForm' + currentTreeId).submit();
        }
    }

    function closePurchaseModal() {
        currentTreeId = null;
        document.getElementById('purchaseModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('purchaseModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePurchaseModal();
        }
    });
</script>
