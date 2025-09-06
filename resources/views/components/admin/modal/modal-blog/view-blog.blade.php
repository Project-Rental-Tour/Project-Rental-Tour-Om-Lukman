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
            <h2 class="text-2xl font-bold mb-2">{{ $blogPost->title }}</h2>
            <p class="text-blue-100">{{ $blogPost->type }}</p>
            <div class="mt-4 flex flex-wrap items-center gap-x-4 text-sm">
                <span class="text-blue-200"><i class="far fa-clock mr-1"></i>
                    {{ $blogPost->created_at->format('M d, Y') }}</span>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <!-- Image -->
            <div class="rounded-lg overflow-hidden border border-gray-200 shadow-md">
                <img 
                    src="{{ asset('storage/' . $blogPost->featured_image) }}" 
                    alt="{{ $blogPost->title }}"
                    class="w-full h-64 object-cover"
                    onerror="this.src=''; this.alt='Image not found';"
                >
            </div>

            <!-- Details -->
            <div class="space-y-4">
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-link text-blue-500 mr-2"></i>
                        <h4 class="font-semibold text-gray-800">Slug</h4>
                    </div>
                    <p class="text-gray-600 truncate">{{ $blogPost->slug }}</p>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="far fa-user text-green-500 mr-2"></i>
                        <h4 class="font-semibold text-gray-800">Author</h4>
                    </div>
                    <p class="text-gray-600">{{ $blogPost->author }}</p>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="far fa-clock text-orange-500 mr-2"></i>
                        <h4 class="font-semibold text-gray-800">Reading Time</h4>
                    </div>
                    <p class="text-gray-600">{{ $blogPost->reading_time }} minutes</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Created</label>
                        <p class="text-sm text-gray-700">{{ $blogPost->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Last Updated</label>
                        <p class="text-sm text-gray-700">{{ $blogPost->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Preview -->
        <div class="mt-6">
            <h4 class="font-semibold text-gray-800 mb-2">Content Preview</h4>
            <div class="prose max-w-none text-gray-700 leading-relaxed">
                {!! Str::limit(strip_tags($blogPost->content), 300, '...') !!}
                @if (strlen(strip_tags($blogPost->content)) > 300)
                    <span class="text-gray-500 text-sm">... continue reading</span>
                @endif
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
                onclick="window.open('{{ asset('storage/' . $blogPost->featured_image) }}', '_blank')">
                View Full Image
            </button>
        </div>
    </div>
</div>