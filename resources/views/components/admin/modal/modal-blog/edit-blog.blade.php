<div
    class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
    <div class="flex items-center justify-between p-6 border-b border-gray-100">
        <div>
            <h3 class="text-xl font-semibold text-gray-800">Edit Blog Post</h3>
            <p class="text-sm text-gray-500 mt-1">Edit the blog post details</p>
        </div>
        <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors" id="close-edit-modal">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="p-6">
        <form class="grid gap-6 md:grid-cols-5" id="edit-form" enctype="multipart/form-data"
            action="{{ route('manage-blog.update', $blogPost->blog_post_id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $blogPost->blog_post_id }}">

            <div class="space-y-4 md:col-span-3">
                <div>
                    <label for="edit-title" class="block mb-1 text-sm font-medium text-gray-700">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="edit-title" name="title" value="{{ old('title', $blogPost->title) }}"
                        required
                        class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Blog post title">
                    <p class="mt-1 text-sm text-red-600 hidden" id="edit-title-error"></p>
                </div>

                <!-- Type Dropdown -->
                <div>
                    <label for="edit-type" class="block mb-1 text-sm font-medium text-gray-700">
                        Type <span class="text-red-500">*</span>
                    </label>
                    <select name="type" id="edit-type" required
                        class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Type</option>
                        <option value="Destination" {{ $blogPost->type == 'Destination' ? 'selected' : '' }}>Destination
                        </option>
                        <option value="Culture" {{ $blogPost->type == 'Culture' ? 'selected' : '' }}>Culture
                        </option>
                        <option value="Food" {{ $blogPost->type == 'Food' ? 'selected' : '' }}>Food
                        </option>
                        <option value="Tips & Guide" {{ $blogPost->type == 'Tips & Guide' ? 'selected' : '' }}>Tips &
                            Guide</option>
                        <option value="Photography" {{ $blogPost->type == 'Photography' ? 'selected' : '' }}>Photography
                        </option>
                    </select>
                    <p class="mt-1 text-sm text-red-600 hidden" id="edit-type-error"></p>
                </div>

                <!-- Reading Time -->
                <div>
                    <label for="edit-reading_time" class="block mb-1 text-sm font-medium text-gray-700">
                        Reading Time (minutes) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="edit-reading_time" name="reading_time"
                        value="{{ old('reading_time', $blogPost->reading_time) }}" min="1" max="120" required
                        class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="e.g. 5">
                    <p class="mt-1 text-sm text-gray-500">Estimated reading time in minutes</p>
                    <p class="mt-1 text-sm text-red-600 hidden" id="edit-reading_time-error"></p>
                </div>

                <div>
                    <label for="edit-content" class="block mb-1 text-sm font-medium text-gray-700">
                        Content <span class="text-red-500">*</span>
                    </label>
                    <input id="edit-content" type="hidden" name="content" value="{{ old('content', $blogPost->content) }}">
                    <trix-editor 
                        input="edit-content" 
                        class="trix-content border border-gray-300 rounded-lg bg-white"
                        style="min-height: 300px; font-family: inherit;"
                    ></trix-editor>
                    <p class="mt-1 text-sm text-red-600 hidden" id="edit-content-error"></p>
                </div>
            </div>

            <div class="md:col-span-2 space-y-4">
                <div>
                    <label for="edit-featured_image" class="block mb-1 text-sm font-medium text-gray-700">
                        Featured Image
                    </label>
                    <input 
                        type="file" 
                        id="edit-featured_image" 
                        name="featured_image" 
                        accept="image/*"
                        data-original-src="{{ asset('storage/' . $blogPost->featured_image) }}"
                        data-preview="edit-previewImage"
                        class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    <p class="mt-1 text-sm text-gray-500">
                        Current: <a href="{{ asset('storage/' . $blogPost->featured_image) }}" target="_blank"
                            class="text-blue-600 hover:underline">View Image</a>
                    </p>
                    <p class="mt-1 text-sm text-red-600 hidden" id="edit-featured_image-error"></p>
                </div>

                <div class="flex flex-col items-center justify-center mt-4">
                    <div
                        class="w-full h-48 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-4">
                        <img 
                            id="edit-previewImage" 
                            src="{{ asset('storage/' . $blogPost->featured_image) }}" 
                            alt="Preview" 
                            class="w-full h-full object-cover rounded-lg"
                            onerror="this.src=''; this.alt='Image not found';"
                        >
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 space-x-3 border-t border-gray-100 md:col-span-5">
                <button type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 "
                    id="cancel-edit">
                    Cancel
                </button>
                <button type="submit"
                    class="flex items-center px-5 py-2.5 text-sm font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 ">
                    <i class="fas fa-save mr-2"></i>
                    Update Blog Post
                </button>
            </div>
        </form>
    </div>
</div>