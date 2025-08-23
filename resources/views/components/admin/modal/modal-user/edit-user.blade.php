<div class="relative w-full max-w-3xl px-4">
    <!-- Modal Container -->
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Edit Employee</h3>
                <p class="text-sm text-gray-500 mt-1">Update the employee information</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="edit-modal-{{ $user->user_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <form class="gap-6 md:grid-cols-5" method="POST" action="{{ route('manage-user.update', $user->user_id) }}">
                @csrf
                @method('PUT')

                <!-- Left Column -->
                <div class="space-y-4 md:col-span-3">
                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block mb-1 text-sm font-medium text-gray-700">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="username" required
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Username" name="username" value="{{ $user->username }}">
                        @error('username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="flex justify-end pt-4 space-x-3 border-t border-gray-100 md:col-span-5">
                    <button type="button"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 "
                        data-modal-toggle="edit-modal-{{ $user->user_id }}">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex items-center px-5 py-2.5 text-sm font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 ">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>