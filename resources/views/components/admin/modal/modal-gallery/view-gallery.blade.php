<div class="relative w-full max-w-4xl px-4 slide-down">
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Gallery Item Details</h3>
                <p class="text-sm text-gray-500 mt-1">View gallery item details</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="view-modal-{{ $gallery->gallery_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6">
            <div class="grid gap-6 md:grid-cols-5">
                <div class="space-y-4 md:col-span-3">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Title</label>
                        <p class="text-gray-900 font-medium">{{ $gallery->title }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Created At</label>
                        <p class="text-gray-600">{{ $gallery->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Updated At</label>
                        <p class="text-gray-600">{{ $gallery->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>

                <div class="md:col-span-2 flex flex-col items-center justify-center">
                    <div class="w-60 h-60 rounded-lg overflow-hidden border border-gray-200">
                        <img src="{{ asset($gallery->gallery_photo) }}" alt="Gallery Image"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 mt-6 border-t border-gray-100">
                <button type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    data-modal-toggle="view-modal-{{ $gallery->gallery_id }}">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>