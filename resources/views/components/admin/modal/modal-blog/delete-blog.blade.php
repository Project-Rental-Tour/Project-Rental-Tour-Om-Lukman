<div
    class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
    <div class="flex items-center justify-between p-6 border-b border-gray-100">
        <div>
            <h3 class="text-xl font-semibold text-gray-800">Delete Blog Post</h3>
            <p class="text-sm text-gray-500 mt-1">Are you sure you want to delete this post?</p>
        </div>
        <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors" id="close-delete-modal">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="p-6">
        <div class="flex items-start mb-4">
            <div class="flex-shrink-0 pt-0.5">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-red-800 font-semibold">Warning</h3>
                <p class="text-red-600">This action cannot be undone. The blog post will be permanently deleted.</p>
            </div>
        </div>

        <p class="mb-4 text-gray-600">Are you sure you want to delete "<span class="font-semibold">The Best Travel
                Destinations in 2023</span>"?</p>

        <div class="bg-gray-50 p-4 rounded-lg mb-4">
            <div class="flex items-center">
                <div class="h-10 w-10 flex-shrink-0">
                    <img class="h-10 w-10 rounded-lg object-cover"
                        src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80"
                        alt="">
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">The Best Travel Destinations in 2023</p>
                    <p class="text-sm text-gray-500">Published on August 15, 2023</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <button type="button"
                class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                id="cancel-delete">
                Cancel
            </button>
            <button type="button"
                class="px-5 py-2.5 text-sm font-medium text-white transition-all bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                id="confirm-delete">
                Delete
            </button>
        </div>
    </div>
</div>