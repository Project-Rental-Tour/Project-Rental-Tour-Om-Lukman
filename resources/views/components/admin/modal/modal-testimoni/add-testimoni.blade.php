<div class="relative w-full max-w-3xl px-4 slide-down">
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 id="modal-title" class="text-xl font-semibold text-gray-800">Add Testimonial</h3>
                <p id="modal-description" class="text-sm text-gray-500 mt-1">Fill the form below to add a new
                    testimonial</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors close-modal-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="testimonial-form" class="p-6" action="{{ route('manage-testimonials.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="testimonial_id" id="testimonial_id">

            <div class="space-y-6">
                <div>
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-700">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name"
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="e.g. Mike Taylor">
                    {{-- Dihapus 'required' karena kolom nullable di controller --}}
                    <p class="mt-1 text-sm text-red-600 hidden" id="name-error"></p>
                </div>

                <div>
                    <label for="role" class="block mb-1 text-sm font-medium text-gray-700">
                        Role / Profession
                    </label>
                    <input type="text" id="role" name="role"
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="e.g. Traveler, Photographer">
                    <p class="mt-1 text-sm text-red-600 hidden" id="role-error"></p>
                </div>

                <div>
                    <label for="location" class="block mb-1 text-sm font-medium text-gray-700">
                        Location
                    </label>
                    <input type="text" id="location" name="location"
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="e.g. USA, Jakarta">
                    <p class="mt-1 text-sm text-red-600 hidden" id="location-error"></p>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">
                        Rating <span class="text-red-500">*</span>
                    </label>
                    <div class="flex space-x-1 mb-2" data-target="add-rating-input">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" class="star-btn text-gray-300 hover:text-yellow-400 transition-colors"
                                data-value="{{ $i }}">
                                <i class="far fa-star text-lg"></i>
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating" value="5">
                    <p class="text-sm text-gray-500">Click the stars to rate (1-5)</p>
                    <p class="mt-1 text-sm text-red-600 hidden" id="rating-error"></p>
                </div>

                <div>
                    <label for="image" class="block mb-1 text-sm font-medium text-gray-700">
                        Image (Optional)
                    </label>
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event, 'add-image-preview')"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <p class="mt-1 text-xs text-gray-500">Max 2MB. Format: JPG, PNG, GIF, SVG.</p>
                    
                    <div id="add-image-preview-container" class="mt-4 hidden">
                        <img id="add-image-preview" class="w-24 h-24 object-cover rounded-lg border border-gray-200 shadow-sm"
                            src="" alt="Image Preview">
                    </div>
                </div>

                <div>
                    <label for="content" class="block mb-1 text-sm font-medium text-gray-700">
                        Testimonial
                    </label>
                    <textarea id="content" name="content" rows="4"
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write the testimonial here..."></textarea>
                    <p class="mt-1 text-sm text-red-600 hidden" id="content-error"></p>
                </div>
            </div>

            <div class="flex justify-end pt-6 space-x-3 border-t border-gray-100 mt-6">
                <button type="button" id="delete-btn"
                    class="hidden px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition"
                    onclick="confirmDelete()">
                    Delete
                </button>

                <button type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition close-modal-btn">
                    Cancel
                </button>
                <button type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                    <span id="submit-text">Add Testimonial</span>
                </button>
            </div>
        </form>
    </div>
</div>