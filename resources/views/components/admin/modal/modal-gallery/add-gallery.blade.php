<div class="relative w-full max-w-3xl px-4 slide-down">
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Add Gallery Item</h3>
                <p class="text-sm text-gray-500 mt-1">Fill the form below to add a new gallery item</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="add-modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6">
            <form class="grid gap-6 md:grid-cols-5" id="add-form" action="{{route('manage-gallery.store')}}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4 md:col-span-3">
                    <div>
                        <label for="title" class="block mb-1 text-sm font-medium text-gray-700">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" required
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Gallery Title" name="title">
                        <p class="mt-1 text-sm text-red-600 hidden" id="title-error"></p>
                    </div>

                    <div>
                        <label for="gallery_photo" class="block mb-1 text-sm font-medium text-gray-700">
                            Image <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="file" 
                            id="gallery_photo" 
                            name="gallery_photo" 
                            accept="image/jpeg,image/png,image/jpg,image/gif"
                            data-preview="previewPhoto"  
                            required
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                        <p class="mt-1 text-sm text-gray-500">JPEG, PNG, JPG, GIF (Max 2MB)</p>
                        <p class="mt-1 text-sm text-red-600 hidden" id="photo-error"></p>
                    </div>
                </div>

                <div class="md:col-span-2 flex flex-col items-center justify-center">
                    <div class="w-40 h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-4">
                        <img id="previewPhoto" src="" alt="Preview" class="w-full h-full object-cover rounded-lg hidden">
                        <span id="placeholderText" class="text-gray-400 text-sm">Image Preview</span>
                    </div>
                </div>

                <div class="flex justify-end pt-4 space-x-3 border-t border-gray-100 md:col-span-5">
                    <button type="button"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 "
                        data-modal-toggle="add-modal">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex items-center px-5 py-2.5 text-sm font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 ">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>