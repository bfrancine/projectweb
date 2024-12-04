@foreach (['create' => 'Add New', 'edit' => 'Edit'] as $mode => $title)
    <div id="{{ $mode }}UserModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-6 border w-[800px] shadow-lg rounded-lg bg-white">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-900">{{ $title }} User</h3>
                <button onclick="closeModal('{{ $mode }}UserModal')" class="text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="{{ $mode }}UserForm" method="POST"
                action="{{ $mode === 'create' ? route('users.store') : '' }}">
                @csrf
                @if ($mode === 'edit')
                    @method('PUT')
                @endif

                <div class="grid grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-700 mb-4">Personal Information</h4>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2"
                                for="{{ $mode }}_first_name">
                                First Name
                            </label>
                            <input type="text" name="first_name" id="{{ $mode }}_first_name" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2"
                                for="{{ $mode }}_last_name">
                                Last Name
                            </label>
                            <input type="text" name="last_name" id="{{ $mode }}_last_name" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $mode }}_email">
                                Email
                            </label>
                            <input type="email" name="email" id="{{ $mode }}_email" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>

                    <!-- Account Details -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-700 mb-4">Account Details</h4>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $mode }}_role">
                                Role
                            </label>
                            <select name="role" id="{{ $mode }}_role" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="">Select a role</option>
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>


                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2"
                                for="{{ $mode }}_password">
                                {{ $mode === 'edit' ? 'New Password' : 'Password' }}
                                @if ($mode === 'edit')
                                    <span class="text-sm font-normal text-gray-500">(leave empty to keep
                                        current)</span>
                                @endif
                            </label>
                            <input type="password" name="password" id="{{ $mode }}_password"
                                {{ $mode === 'create' ? 'required' : '' }}
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2"
                                for="{{ $mode }}_password_confirmation">
                                Confirm Password
                            </label>
                            <input type="password" name="password_confirmation"
                                id="{{ $mode }}_password_confirmation"
                                {{ $mode === 'create' ? 'required' : '' }}
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6 pt-4 border-t">
                    <button type="button" onclick="closeModal('{{ $mode }}UserModal')"
                        class="bg-white text-gray-700 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 mr-2">
                        Cancel
                    </button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        {{ $mode === 'create' ? 'Create' : 'Update' }} User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endforeach

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function editUser(user) {
        // Set form action URL
        document.getElementById('editUserForm').action = `/admin/users/${user.id}`;

        // Fill form fields
        document.getElementById('edit_first_name').value = user.first_name;
        document.getElementById('edit_last_name').value = user.last_name;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_role').value = user.role;

        // Clear password fields
        document.getElementById('edit_password').value = '';
        document.getElementById('edit_password_confirmation').value = '';

        // Show modal
        openModal('editUserModal');
    }
</script>
