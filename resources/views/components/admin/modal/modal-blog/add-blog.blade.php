<div
    class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
    <div class="flex items-center justify-between p-6 border-b border-gray-100">
        <div>
            <h3 class="text-xl font-semibold text-gray-800">Add Blog Post</h3>
            <p class="text-sm text-gray-500 mt-1">Fill the form below to add a new blog post</p>
        </div>
        <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors" id="close-add-modal">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="p-6">
        <form class="grid gap-6 md:grid-cols-5" id="add-form" enctype="multipart/form-data"
            action="{{ route('manage-blog.store') }}" method="POST">
            @csrf
            <div class="space-y-4 md:col-span-3">
                <div>
                    <label for="title" class="block mb-1 text-sm font-medium text-gray-700">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Blog post title">
                    <p class="mt-1 text-sm text-red-600 hidden" id="title-error"></p>
                </div>

                <!-- Type Dropdown -->
                <div>
                    <label for="type" class="block mb-1 text-sm font-medium text-gray-700">
                        Type <span class="text-red-500">*</span>
                    </label>
                    <select name="type" id="type" required
                        class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Type</option>
                        <option value="Destination">Destination</option>
                        <option value="Culture">Culture</option>
                        <option value="Food">Food</option>
                        <option value="Tips & Guide">Tips & Guide</option>
                        <option value="Photography">Photography</option>
                    </select>
                    <p class="mt-1 text-sm text-red-600 hidden" id="type-error"></p>
                </div>

                <!-- Reading Time -->
                <div>
                    <label for="reading_time" class="block mb-1 text-sm font-medium text-gray-700">
                        Reading Time (minutes) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="reading_time" name="reading_time" min="1" max="120" required
                        class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="e.g. 5">
                    <p class="mt-1 text-sm text-gray-500">Estimated reading time in minutes</p>
                    <p class="mt-1 text-sm text-red-600 hidden" id="reading_time-error"></p>
                </div>

                <div>
                    <label for="content" class="block mb-1 text-sm font-medium text-gray-700">
                        Content <span class="text-red-500">*</span>
                    </label>
                    <textarea id="content" name="content"
                        class="w-full h-48 px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg"></textarea>
                    <p class="mt-1 text-sm text-red-600 hidden" id="content-error"></p>
                </div>
            </div>

            <div class="md:col-span-2 space-y-4">
                <div>
                    <label for="featured_image" class="block mb-1 text-sm font-medium text-gray-700">
                        Featured Image <span class="text-red-500">*</span>
                    </label>
                    <input type="file" id="featured_image" name="featured_image" accept="image/*" required
                        class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">JPEG, PNG, JPG, GIF (Max 2MB)</p>
                    <p class="mt-1 text-sm text-red-600 hidden" id="featured_image-error"></p>
                </div>

                <div class="flex flex-col items-center justify-center mt-4">
                    <div
                        class="w-full h-48 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-4">
                        <img id="previewPhoto" src="" alt="Preview"
                            class="w-full h-full object-cover rounded-lg hidden">
                        <span id="placeholderText" class="text-gray-400 text-sm">Image Preview</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 space-x-3 border-t border-gray-100 md:col-span-5">
                <button type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 "
                    id="cancel-add">
                    Cancel
                </button>
                <button type="submit"
                    class="flex items-center px-5 py-2.5 text-sm font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 ">
                    <i class="fas fa-plus mr-2"></i>
                    Add Blog Post
                </button>
            </div>
        </form>
    </div>
</div>