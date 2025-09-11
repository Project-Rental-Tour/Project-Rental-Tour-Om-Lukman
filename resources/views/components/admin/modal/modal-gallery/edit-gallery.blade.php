<!-- components/admin/modal/modal-gallery/edit-gallery.blade.php -->
<div class="relative w-full max-w-3xl px-4 slide-down">
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Edit Gallery Item</h3>
                <p class="text-sm text-gray-500 mt-1">Edit the gallery item details</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="edit-modal-{{ $gallery->gallery_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6">
            <form class="grid gap-6 md:grid-cols-5" id="edit-form-{{ $gallery->gallery_id }}"
                enctype="multipart/form-data" action="{{ route('manage-gallery.update', $gallery->gallery_id) }}"
                method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $gallery->gallery_id }}">

                <div class="space-y-4 md:col-span-3">
                    <div>
                        <label for="edit-title-{{ $gallery->gallery_id }}"
                            class="block mb-1 text-sm font-medium text-gray-700">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit-title-{{ $gallery->gallery_id }}" required
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Gallery Title" name="title" value="{{ $gallery->title }}">
                        <p class="mt-1 text-sm text-red-600 hidden" id="edit-title-error-{{ $gallery->gallery_id }}">
                        </p>
                    </div>

                    <div>
                        <label for="edit-tag-{{ $gallery->gallery_id }}" class="block mb-1 text-sm font-medium text-gray-700">
                            Tags (Optional)
                        </label>
                        <input type="text" id="edit-tag-{{ $gallery->gallery_id }}" name="tag"
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="e.g. bali, beach, sunset, adventure"
                            value="{{ implode(', ', $gallery->tag ?? []) }}">
                        <p class="mt-1 text-sm text-gray-500">Separate tags with commas</p>
                        <p class="mt-1 text-sm text-red-600 hidden" id="edit-tag-error-{{ $gallery->gallery_id }}"></p>
                    </div>

                    <div>
                        <label for="edit-gallery_photo-{{ $gallery->gallery_id }}"
                            class="block mb-1 text-sm font-medium text-gray-700">
                            Image (Leave empty to keep current)
                        </label>
                        <input 
                            type="file" 
                            id="edit-gallery_photo-{{ $gallery->gallery_id }}" 
                            name="gallery_photo" 
                            accept="image/jpeg,image/png,image/jpg,image/gif"
                            data-original-src="{{ asset($gallery->gallery_photo) }}"
                            data-preview="edit-preview-{{ $gallery->gallery_id }}"
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                        <p class="mt-1 text-sm text-gray-500">
                            Current:
                            <a href="{{ asset($gallery->gallery_photo) }}" target="_blank"
                                class="text-blue-600 hover:underline current-image-link"
                                id="current-image-link-{{ $gallery->gallery_id }}">
                                View Image
                            </a>
                        </p>
                        <p class="mt-1 text-sm text-red-600 hidden" id="edit-photo-error-{{ $gallery->gallery_id }}">
                        </p>
                    </div>
                </div>

                <div class="md:col-span-2 flex flex-col items-center justify-center">
                    <div
                        class="w-40 h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-4">
                        <img 
                            id="edit-preview-{{ $gallery->gallery_id }}" 
                            src="{{ asset($gallery->gallery_photo) }}" 
                            alt="Preview" 
                            class="w-full h-full object-cover rounded-lg"
                            onerror="this.src=''; this.alt='Image not found';"
                        >
                    </div>
                </div>

                <div class="flex justify-end pt-4 space-x-3 border-t border-gray-100 md:col-span-5">
                    <button type="button"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 "
                        data-modal-toggle="edit-modal-{{ $gallery->gallery_id }}">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex items-center px-5 py-2.5 text-sm font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 ">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>