<div class="relative w-full max-w-4xl px-4 slide-down">
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Car Details: {{ $car->name_car }}</h3>
                <p class="text-sm text-gray-500 mt-1">View car information</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="view-car-modal-{{ $car->car_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6">
            <div class="grid gap-6 md:grid-cols-5">
                <div class="space-y-4 md:col-span-3">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Car Name</label>
                        <p class="text-gray-900 font-medium">{{ $car->name_car }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Slug</label>
                        <p class="text-gray-600 break-all">{{ $car->slug }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Description</label>
                        <p class="text-gray-700 whitespace-pre-line">{{ $car->description }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Type</label>
                        <p class="text-gray-600">{{ $car->car_type ?? '—' }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Transmission</label>
                        <p class="text-gray-600 capitalize">{{ $car->transmission }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Price</label>
                        <p class="text-gray-900 font-medium">Rp{{ number_format($car->price, 0, ',', '.') }} / day</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Capacity</label>
                        <p class="text-gray-600">{{ $car->capacity }} seats</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Status</label>
                        <span class="px-2 py-1 text-xs font-medium rounded-full
                            @if($car->car_status == 'available') bg-green-100 text-green-800
                            @elseif($car->car_status == 'booked') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($car->car_status) }}
                        </span>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Rental Type</label>
                        <p class="text-gray-600">{{ $car->rental_type ? 'With Driver' : 'Standard' }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Notes</label>
                        <p class="text-gray-700">{{ $car->notes ?? '—' }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Created At</label>
                        <p class="text-gray-600">{{ $car->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Updated At</label>
                        <p class="text-gray-600">{{ $car->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>

                <div class="md:col-span-2 space-y-4">
                    @if($car->image_car_1)
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Main Image</label>
                        <div class="w-full h-40 rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ asset($car->image_car_1) }}" alt="Main Image" class="w-full h-full object-cover">
                        </div>
                    </div>
                    @endif

                    @if($car->image_car_2)
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Image 2</label>
                        <div class="w-full h-40 rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ asset($car->image_car_2) }}" alt="Image 2" class="w-full h-full object-cover">
                        </div>
                    </div>
                    @endif

                    @if($car->image_car_3)
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Image 3</label>
                        <div class="w-full h-40 rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ asset($car->image_car_3) }}" alt="Image 3" class="w-full h-full object-cover">
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="flex justify-end pt-4 mt-6 border-t border-gray-100">
                <button type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50"
                    data-modal-toggle="view-car-modal-{{ $car->car_id }}">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>