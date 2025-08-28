<div class="relative w-full max-w-3xl px-4 slide-down">
    @isset($booking)
        <!-- Modal Content -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-blue-600 text-white px-6 py-4">
                <h3 class="text-xl font-bold">Booking Details</h3>
                <p class="text-blue-100">{{ $booking->first_name }} {{ $booking->last_name }}</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Package Type Badge -->
                <div class="flex justify-end">
                    <span
                        class="px-3 py-1 text-xs font-medium rounded-full 
                        {{ $booking->package_type == 'regular' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800' }}">
                        {{ ucfirst($booking->package_type) }} Booking
                    </span>
                </div>

                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-800">Full Name</h4>
                        <p class="text-gray-600">{{ $booking->first_name }} {{ $booking->last_name }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-800">Email</h4>
                        <p class="text-gray-600">{{ $booking->email }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-800">Country</h4>
                        <p class="text-gray-600">{{ $booking->country }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-800">Travel Date</h4>
                        <p class="text-gray-600">{{ \Carbon\Carbon::parse($booking->travel_date)->format('M d, Y') }}</p>
                    </div>
                </div>

                <!-- Regular Booking Details -->
                @if($booking->package_type === 'regular')
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-800 mb-2">Regular Package Details</h4>
                        <div class="space-y-2 text-sm text-blue-700">
                            <p><strong>Destination:</strong> {{ $booking->destination_name }}</p>
                            <p><strong>Duration:</strong> {{ $booking->duration_nights ?? 'N/A' }} nights</p>
                            <p><strong>Transportation:</strong> Private AC Car & Boat</p>
                            <p><strong>Accommodation:</strong> 3-Star Beachfront Resort</p>
                        </div>
                    </div>
                @endif

                <!-- Custom Booking Details -->
                @if($booking->package_type === 'custom')
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <h4 class="font-semibold text-purple-800 mb-2">Custom Trip Request</h4>
                        <div class="space-y-2 text-sm text-purple-700">
                            <p><strong>Destinations:</strong> {{ $booking->custom_destinations }}</p>
                            <p><strong>Travelers:</strong> {{ $booking->travelers }}</p>
                            <p><strong>Duration:</strong> {{ $booking->duration_nights ?? 'Not specified' }} nights</p>
                            <p><strong>Budget:</strong> {{ $booking->budget_range ?? 'Not specified' }}</p>
                            <p><strong>Interests:</strong>
                                {{ $booking->interests ? implode(', ', json_decode($booking->interests, true)) : 'Not specified' }}
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Message -->
                @if($booking->message)
                    <div class="bg-gray-50 border-l-4 border-gray-400 p-4 rounded">
                        <h4 class="font-semibold text-gray-800 mb-2">Special Request</h4>
                        <p class="text-gray-700">{{ $booking->message }}</p>
                    </div>
                @endif

                <!-- Footer -->
                <div class="flex justify-end pt-4 border-t">
                    <button type="button" data-modal-hide="view-modal-{{ $booking->booking_id }}"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                        Close
                    </button>
                </div>
            </div>
        </div>

        <!-- Close backdrop -->
        <div class="fixed inset-0 bg-black opacity-30 z-[-1]" data-modal-hide="view-modal-{{ $booking->booking_id }}"></div>

    @endisset
</div>