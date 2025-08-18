<div class="relative w-full max-w-3xl px-4">
    <!-- Modal Container -->
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Employee Details</h3>
                <p class="text-sm text-gray-500 mt-1">View employee information</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="view-modal-{{ $user->user_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Username -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-500">Username</label>
                    <p class="text-gray-800">{{ $user->username }}</p>
                </div>

                <!-- Account Created At -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-500">Account Created</label>
                    <p class="text-gray-800">{{ $user->created_at->format('d M Y') }}</p>
                </div>

                <!-- Last Updated -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-500">Last Updated</label>
                    <p class="text-gray-800">{{ $user->updated_at->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end pt-6 mt-6 border-t border-gray-100">
                <button type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    data-modal-toggle="view-modal-{{ $user->user_id }}">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>