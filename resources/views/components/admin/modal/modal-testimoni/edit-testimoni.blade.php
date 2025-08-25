<div class="relative w-full max-w-3xl px-4">
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Edit Testimonial</h3>
                <p class="text-sm text-gray-500 mt-1">Update the testimonial details</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500"
                data-modal-toggle="edit-modal-{{ $testimoni->testimonial_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('manage-testimonials.update', $testimoni->testimonial_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" value="{{ $testimoni->name }}" required
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Role / Profession</label>
                    <input type="text" name="role" value="{{ $testimoni->role }}"
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" value="{{ $testimoni->location }}" required
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Rating</label>
                    <div class="flex space-x-1 mb-2" id="edit-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button"
                                class="star-btn {{ $i <= $testimoni->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                data-value="{{ $i }}">
                                <i class="fas fa-star text-lg"></i>
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="edit-rating" value="{{ $testimoni->rating }}">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Testimonial</label>
                    <textarea name="content" rows="4" required
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $testimoni->content }}</textarea>
                </div>
            </div>

            <div class="flex justify-end pt-4 space-x-3 border-t border-gray-100">
                <button type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50"
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