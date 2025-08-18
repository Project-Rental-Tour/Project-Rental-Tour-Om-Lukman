<div class="relative w-full max-w-3xl px-4">
    <!-- Modal Container -->
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Add New Employee</h3>
                <p class="text-sm text-gray-500 mt-1">Fill the form below to add a new employee</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="add-modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <form class=" gap-6 md:grid-cols-5" method="POST" action="{{ route('manage-user.store') }}"
                enctype="multipart/form-data">
                @csrf

                <!-- Left Column -->
                <div class="space-y-4 md:col-span-3">
                    <!-- Name Field -->
                    <div>
                        <label for="text" class="block mb-1 text-sm font-medium text-gray-700">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="text" required
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Username" name="username" value="{{ old('username') }}">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Fields -->
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="password" class="block mb-1 text-sm font-medium text-gray-700">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" id="password" required
                                class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Password" name="password">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block mb-1 text-sm font-medium text-gray-700">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" id="password_confirmation" required
                                class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Confirm Password" name="password_confirmation">
                        </div>
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="flex justify-end pt-4 space-x-3 border-t border-gray-100 md:col-span-5">
                    <button type="button"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        data-modal-toggle="add-modal">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex items-center px-5 py-2.5 text-sm font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Save Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>