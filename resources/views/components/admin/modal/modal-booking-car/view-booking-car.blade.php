<div class="relative w-full max-w-4xl px-4 slide-down">
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Booking Details: {{ $booking->customer_name }}</h3>
                <p class="text-sm text-gray-500 mt-1">View booking information</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="view-booking-modal-{{ $booking->booking_cars_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6">
            <div class="grid gap-6 md:grid-cols-5">
                <div class="space-y-4 md:col-span-3">
                    <!-- Customer Info -->
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Customer Name</label>
                        <p class="text-gray-900 font-medium">{{ $booking->customer_name }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Phone Number</label>
                        <p class="text-gray-600">
                            <a href="https://wa.me/{{ $booking->customer_phone }}" target="_blank" class="text-blue-600 hover:underline hover:text-blue-800">
                                {{ $booking->customer_phone }}
                            </a>
                        </p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                        <p class="text-gray-600">
                            @if($booking->customer_email)
                                <a href="mailto:{{ $booking->customer_email }}" class="text-blue-600 hover:underline hover:text-blue-800">
                                    {{ $booking->customer_email }}
                                </a>
                            @else
                                —
                            @endif
                        </p>
                    </div>

                    <!-- Car Info -->
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Car</label>
                        <p class="text-gray-900 font-medium">{{ $booking->car->name_car }}</p>
                        <p class="text-gray-600 text-sm">{{ $booking->car->car_type ?? '—' }}</p>
                    </div>

                    <!-- Rental Type -->
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Rental Type</label>
                        <p class="text-gray-600">{{ $booking->rental_type ? 'With Driver' : 'Self Drive' }}</p>
                    </div>

                    <!-- Dates & Duration -->
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Start Date</label>
                        <p class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">End Date</label>
                        <p class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Duration</label>
                        <p class="text-gray-900 font-medium">{{ $booking->duration_days }} days</p>
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Total Price</label>
                        <p class="text-gray-900 font-medium">Rp{{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        <p class="text-gray-600 text-sm">({{ $booking->car->price }} / day × {{ $booking->duration_days }} days)</p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Booking Status</label>
                        <span class="px-2 py-1 text-xs font-medium rounded-full
                            @if($booking->booking_status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($booking->booking_status == 'confirmed') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($booking->booking_status) }}
                        </span>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Notes</label>
                        <p class="text-gray-700 whitespace-pre-line">{{ $booking->notes ?? '—' }}</p>
                    </div>

                    <!-- Timestamps -->
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Created At</label>
                        <p class="text-gray-600">{{ $booking->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Updated At</label>
                        <p class="text-gray-600">{{ $booking->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>

                <div class="md:col-span-2 space-y-4">
                    <!-- Car Images -->
                    @if($booking->car->image_car_1)
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Car Image</label>
                        <div class="w-full h-40 rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ asset($booking->car->image_car_1) }}" alt="{{ $booking->car->name_car }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    @endif

                    @if($booking->car->image_car_2)
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Additional Image</label>
                        <div class="w-full h-40 rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ asset($booking->car->image_car_2) }}" alt="{{ $booking->car->name_car }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    @endif

                    @if($booking->car->image_car_3)
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Additional Image</label>
                        <div class="w-full h-40 rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ asset($booking->car->image_car_3) }}" alt="{{ $booking->car->name_car }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    @endif

                    <!-- Quick Actions -->
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <h4 class="font-medium text-gray-800 mb-3">Quick Actions</h4>
                        <div class="space-y-2">
                            <a href="https://wa.me/{{ $booking->customer_phone }}"
                                target="_blank"
                                class="flex items-center w-full px-3 py-2 text-sm text-green-700 bg-green-50 rounded-md hover:bg-green-100 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                WhatsApp Customer
                            </a>
                            @if($booking->customer_email)
                            <a href="mailto:{{ $booking->customer_email }}"
                                class="flex items-center w-full px-3 py-2 text-sm text-blue-700 bg-blue-50 rounded-md hover:bg-blue-100 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Email Customer
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 mt-6 border-t border-gray-100">
                <button type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50"
                    data-modal-toggle="view-booking-modal-{{ $booking->booking_cars_id }}">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>