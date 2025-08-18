<div class="relative w-full max-w-md px-4">
    <!-- Modal Container -->
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Delete Employee</h3>
                <p class="text-sm text-gray-500 mt-1">Are you sure you want to delete this employee?</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="delete-modal-{{ $user->user_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <div class="mb-4">
                <p class="text-gray-600">You're about to delete <span
                        class="font-semibold">{{ $user->username }}</span>. This action cannot be undone.</p>
            </div>

            <form method="POST" action="{{ route('manage-user.destroy', $user->user_id) }}" class="mt-6">
                @csrf
                @method('DELETE')

                <div class="flex justify-end space-x-3">
                    <button type="button"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        data-modal-toggle="delete-modal-{{ $user->user_id }}">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex items-center px-5 py-2.5 text-sm font-medium text-white transition-all bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>