<div class="relative w-full max-w-md px-4 slide-down">
    <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Confirm Delete</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500 close-delete-modal-btn"
                data-modal-toggle="delete-modal-{{ $testimoni->testimonial_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6">
            <p class="text-gray-700">Are you sure you want to delete this testimonial?</p>
            <p class="text-sm text-gray-500 mt-2">This action cannot be undone.</p>

            <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                <p class="text-sm font-medium text-gray-700">Testimonial Details:</p>
                <p class="text-sm text-gray-600"><strong>Name:</strong> {{ $testimoni->name ?? 'N/A' }}</p>
                <p class="text-sm text-gray-600"><strong>Role:</strong> {{ $testimoni->role ?? 'N/A' }}</p>
                <p class="text-sm text-gray-600"><strong>Rating:</strong>
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $testimoni->rating)
                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                        @else
                            <i class="far fa-star text-gray-300 text-xs"></i>
                        @endif
                    @endfor
                </p>
            </div>
        </div>

        <div class="flex justify-end pt-4 space-x-3 border-t border-gray-100 p-6">
            <button type="button"
                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition close-delete-modal-btn"
                data-modal-toggle="delete-modal-{{ $testimoni->testimonial_id }}">
                Cancel
            </button>
            <form action="{{ route('manage-testimonials.destroy', $testimoni->testimonial_id) }}" method="POST"
                class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                    Delete Testimonial
                </button>
            </form>
        </div>
    </div>
</div>