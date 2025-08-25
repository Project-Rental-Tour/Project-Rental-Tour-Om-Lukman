<div class="relative bg-white rounded-xl shadow-xl max-w-3xl w-full mx-4">
    <div class="flex items-center justify-between p-6 border-b border-gray-100">
        <div>
            <h3 class="text-xl font-semibold text-gray-800">Testimonial Details</h3>
            <p class="text-sm text-gray-500 mt-1">Complete testimonial information</p>
        </div>
        <button type="button" class="text-gray-400 hover:text-gray-500" data-modal-toggle="testimonial-modal">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div class="p-6 space-y-6">
        <!-- Name -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-1">
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
            </div>
            <div class="md:col-span-2">
                <p class="text-gray-900 font-medium">{{ $testimoni->name }}</p>
            </div>
        </div>

        <!-- Role -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-1">
                <label class="block text-sm font-medium text-gray-700">Role / Profession</label>
            </div>
            <div class="md:col-span-2">
                <p class="text-gray-900">{{ $testimoni->role ?? 'Not specified' }}</p>
            </div>
        </div>

        <!-- Location -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-1">
                <label class="block text-sm font-medium text-gray-700">Location</label>
            </div>
            <div class="md:col-span-2">
                <p class="text-gray-900">{{ $testimoni->location }}</p>
            </div>
        </div>

        <!-- Rating -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-1">
                <label class="block text-sm font-medium text-gray-700">Rating</label>
            </div>
            <div class="md:col-span-2">
                <div class="flex items-center">
                    <div class="flex text-yellow-400 mr-2">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $testimoni->rating)
                                <i class="fas fa-star text-lg"></i>
                            @else
                                <i class="far fa-star text-lg text-gray-300"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="text-sm text-gray-600">({{ $testimoni->rating }}/5)</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-1">
                <label class="block text-sm font-medium text-gray-700">Testimonial Content</label>
            </div>
            <div class="md:col-span-2">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $testimoni->content }}</p>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-1">
                <label class="block text-sm font-medium text-gray-700">Additional Information</label>
            </div>
            <div class="md:col-span-2">
                <div class="text-sm text-gray-600 space-y-1">
                    <p><strong>Created:</strong> {{ $testimoni->created_at->format('M d, Y H:i') }}</p>
                    <p><strong>Last Updated:</strong> {{ $testimoni->updated_at->format('M d, Y H:i') }}</p>
                    <p><strong>ID:</strong> {{ $testimoni->testimonial_id }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-end pt-4 space-x-3 border-t border-gray-100 p-6">
        <button type="button"
            class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition"
            data-modal-toggle="testimonial-modal">
            Close
        </button>
        <a href="#" data-modal-target="edit" data-id="{{ $testimoni->testimonial_id }}"
            class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
            Edit Testimonial
        </a>
    </div>
</div>