<div class="relative w-full max-w-3xl px-4 slide-down">
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden w-full max-w-3xl">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Edit Testimonial</h3>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 close-edit-modal-btn"
                data-modal-toggle="edit-modal-{{ $testimoni->testimonial_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form action="{{ route('manage-testimonials.update', $testimoni->testimonial_id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" value="{{ $testimoni->name }}"
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Role / Profession</label>
                    <input type="text" name="role" value="{{ $testimoni->role }}"
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" value="{{ $testimoni->location }}"
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Rating</label>
                    <div class="flex space-x-1 mb-2" data-target="edit-rating-input-{{ $testimoni->testimonial_id }}">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button"
                                class="star-btn {{ $i <= $testimoni->rating ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400 transition-colors"
                                data-value="{{ $i }}">
                                <i class="fas fa-star text-lg"></i>
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="edit-rating-{{ $testimoni->testimonial_id }}"
                        value="{{ $testimoni->rating }}">
                    <p class="text-sm text-gray-500">Click the stars to rate (1-5)</p>
                </div>

                <div>
                    <label for="edit-image-{{ $testimoni->testimonial_id }}"
                        class="block mb-1 text-sm font-medium text-gray-700">
                        Image (Optional)
                    </label>
                    <input type="file" id="edit-image-{{ $testimoni->testimonial_id }}" name="image" accept="image/*"
                        onchange="previewImage(event, 'edit-image-preview-{{ $testimoni->testimonial_id }}')"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <p class="mt-1 text-xs text-gray-500">Max 2MB. Format: JPG, PNG, GIF, SVG. Uploading new image will replace the old one.</p>

                    <div class="mt-4 flex items-start space-x-4">
                        @if ($testimoni->image)
                            <div id="current-image-container-{{ $testimoni->testimonial_id }}" class="relative">
                                <img id="edit-image-preview-{{ $testimoni->testimonial_id }}"
                                    src="{{ Storage::url($testimoni->image) }}"
                                    class="w-24 h-24 object-cover rounded-lg border border-gray-200 shadow-sm"
                                    alt="Current Image">
                                <span class="absolute top-0 left-0 bg-blue-600 text-white text-xs px-1.5 py-0.5 rounded-br-lg font-medium">Current</span>
                            </div>
                        @else
                            <div id="current-image-container-{{ $testimoni->testimonial_id }}" class="hidden">
                                <img id="edit-image-preview-{{ $testimoni->testimonial_id }}"
                                    class="w-24 h-24 object-cover rounded-lg border border-gray-200 shadow-sm hidden"
                                    src="" alt="Image Preview">
                            </div>
                        @endif
                        
                        <div id="new-image-placeholder-{{ $testimoni->testimonial_id }}" class="{{ $testimoni->image ? 'hidden' : 'block' }}">
                            <img id="edit-image-preview-{{ $testimoni->testimonial_id }}"
                                class="w-24 h-24 object-cover rounded-lg border border-gray-200 shadow-sm hidden"
                                src="" alt="Image Preview">
                        </div>
                    </div>

                    @if ($testimoni->image)
                        <div class="mt-4 flex items-center">
                            <input id="remove-image-{{ $testimoni->testimonial_id }}" type="checkbox" name="remove_image" value="1"
                                class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500">
                            <label for="remove-image-{{ $testimoni->testimonial_id }}" class="ml-2 text-sm font-medium text-gray-700">
                                Remove current image
                            </label>
                        </div>
                    @endif
                </div>


                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Testimonial</label>
                    <textarea name="content" rows="4"
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $testimoni->content }}</textarea>
                </div>
            </div>

            <div class="flex justify-end space-x-3 p-6 border-t border-gray-100">
                <button type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition close-edit-modal-btn"
                    data-modal-toggle="edit-modal-{{ $testimoni->testimonial_id }}">
                    Cancel
                </button>
                <button type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                    Update Testimonial
                </button>
            </div>
        </form>
    </div>
</div>