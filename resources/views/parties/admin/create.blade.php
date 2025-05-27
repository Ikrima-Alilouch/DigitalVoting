<x-layouts.default>
    <x-slot name="title">Create Party</x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Create New Party</h1>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <form action="{{ route('admin.parties.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Party Name</label>
                            <div class="mt-1 flex items-center space-x-4">
                                <input type="text" name="name" id="name" required
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <div class="flex-shrink-0">
                                    <label for="party_image" class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                        Select Image
                                        <input type="file" name="party_image" id="party_image" accept="image/*" class="hidden" required>
                                    </label>
                                </div>
                            </div>
                            <div id="image_preview" class="mt-2 hidden">
                                <img src="" alt="Party Image Preview" class="h-20 w-20 object-cover rounded-md">
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="active">Active</option>
                                <option value="deactivated">Deactivated</option>
                            </select>
                        </div>

                        <div class="border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Party Leader</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="leader_firstname" class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input type="text" name="leader_firstname" id="leader_firstname" required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="leader_infix" class="block text-sm font-medium text-gray-700">Infix</label>
                                    <input type="text" name="leader_infix" id="leader_infix"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="leader_lastname" class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input type="text" name="leader_lastname" id="leader_lastname" required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>

                        <div class="border-t pt-6 hidden" id="members_section">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Party Members</h3>
                                <button type="button" onclick="addMember()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                    Add Member
                                </button>
                            </div>
                            <div id="members-container">
                                <!-- Members will be added here dynamically -->
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.parties.index') }}"
                           class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</a>
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Create Party</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('party_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('image_preview');
                    preview.classList.remove('hidden');
                    preview.querySelector('img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Form validation for party leader
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent form submission by default
            
            const leaderFirstname = document.getElementById('leader_firstname').value.trim();
            const leaderLastname = document.getElementById('leader_lastname').value.trim();
            
            if (!leaderFirstname || !leaderLastname) {
                alert('You cannot create a party without a party leader. Please fill in the party leader\'s first and last name.');
                return false;
            }
            
            // If validation passes, submit the form
            this.submit();
        });

        function addMember() {
            const container = document.getElementById('members-container');
            const memberIndex = container.children.length;
            
            const memberHtml = `
                <div class="member-entry border-b pb-4 mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-md font-medium text-gray-700">Member ${memberIndex + 1}</h4>
                        <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-red-600 hover:text-red-900">
                            Remove
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="members[${memberIndex}][firstname]" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Infix</label>
                            <input type="text" name="members[${memberIndex}][infix]"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="members[${memberIndex}][lastname]" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="members[${memberIndex}][role]" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Role</option>
                                <option value="member">Member</option>
                                <option value="secretary">Secretary</option>
                                <option value="treasurer">Treasurer</option>
                                <option value="vice_leader">Vice Leader</option>
                                <option value="spokesperson">Spokesperson</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', memberHtml);
        }
    </script>
</x-layouts.default> 