<div class="relative w-full max-w-md px-4 slide-down">
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Delete Car</h3>
                <p class="text-sm text-gray-500 mt-1">Are you sure you want to delete this car?</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="delete-car-modal-{{ $car->car_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6">
            <p class="mb-4 text-gray-600">Are you sure you want to delete "<span
                    class="font-semibold">{{ $car->name_car }}</span>"? This action cannot be undone.</p>
            <div class="flex justify-end space-x-3">
                <button type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50"
                    data-modal-toggle="delete-car-modal-{{ $car->car_id }}">
                    Cancel
                </button>
                <form action="{{ route('manage-car.destroy', $car->car_id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white transition-all bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>