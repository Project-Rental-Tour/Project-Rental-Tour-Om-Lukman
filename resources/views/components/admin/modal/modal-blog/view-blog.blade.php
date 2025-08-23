<div
    class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
    <div class="flex items-center justify-between p-6 border-b border-gray-100">
        <div>
            <h3 class="text-xl font-semibold text-gray-800">View Blog Post</h3>
            <p class="text-sm text-gray-500 mt-1">Complete blog post details</p>
        </div>
        <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors" id="close-view-modal">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="p-6">
        <!-- Header Card -->
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 rounded-xl text-white mb-6">
            <h2 class="text-2xl font-bold mb-2">The Best Travel Destinations in 2023</h2>
            <p class="text-blue-100">Travel & Adventure</p>
            <div class="mt-4 flex items-center">
                <span class="bg-blue-700 text-blue-100 text-xs font-semibold px-2.5 py-0.5 rounded">Published</span>
                <span class="text-blue-200 ml-4"><i class="far fa-clock mr-1"></i> August 15, 2023</span>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <!-- Image -->
            <div class="rounded-lg overflow-hidden border border-gray-200 shadow-md">
                <img src="https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80"
                    alt="Travel Destinations" class="w-full h-64 object-cover">
            </div>

            <!-- Details -->
            <div class="space-y-4">
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-link text-blue-500 mr-2"></i>
                        <h4 class="font-semibold text-gray-800">Slug</h4>
                    </div>
                    <p class="text-gray-600">best-travel-destinations-2023</p>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="far fa-user text-green-500 mr-2"></i>
                        <h4 class="font-semibold text-gray-800">Author</h4>
                    </div>
                    <p class="text-gray-600">John Doe</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Created</label>
                        <p class="text-sm text-gray-700">Aug 15, 2023</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Last Updated</label>
                        <p class="text-sm text-gray-700">Aug 18, 2023</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Preview -->
        <div class="mt-6">
            <h4 class="font-semibold text-gray-800 mb-2">Content Preview</h4>
            <div class="content-preview">
                <p>Are you looking for the best travel destinations to visit in 2023? Look no further! We've compiled a
                    list of the most amazing places you should consider for your next adventure.</p>
                <p class="mt-4">From the pristine beaches of Bali to the historic streets of Rome, 2023 offers endless
                    opportunities for exploration and discovery. Whether you're an adventure seeker or a culture
                    enthusiast, there's something for everyone.</p>
                <p class="mt-4">Don't miss out on these incredible destinations that will make your 2023 travel
                    experiences unforgettable.</p>
            </div>
        </div>

        <div class="flex justify-end pt-6 mt-6 border-t border-gray-100 space-x-3">
            <button type="button"
                class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 "
                id="close-view-modal-btn">
                Close
            </button>
            <button type="button"
                class="px-5 py-2.5 text-sm font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 "
                onclick="window.open('https://images.unsplash.com/photo-1542435503-956c469947f6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80', '_blank')">
                View Full Image
            </button>
        </div>
    </div>
</div>