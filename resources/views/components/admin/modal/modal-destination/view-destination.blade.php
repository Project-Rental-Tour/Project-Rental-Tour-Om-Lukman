<div class="relative w-full max-w-3xl px-4 slide-down">
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Destination Package</h3>
                <p class="text-sm text-gray-500 mt-1">Complete package details</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="view-modal-{{ $destination->destination_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 rounded-xl text-white mb-6">
                <h2 class="text-2xl font-bold mb-2">{{ $destination->name_package }}</h2>
                <p class="text-blue-100">{{ $destination->place }}</p>
                <div class="mt-4">
                    <span class="text-3xl font-bold">Rp.
                        {{ number_format((float) $destination->price, 0, ',', '.') }}</span>
                    <span class="text-blue-200 ml-2">per person</span>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <!-- Image -->
                <div class="rounded-lg overflow-hidden border border-gray-200 shadow-md">
                    <img src="{{ asset($destination->destination_photo) }}" alt="{{ $destination->name_package }}"
                        class="w-full h-64 object-cover">
                </div>

                <!-- Details -->
                <div class="space-y-4">
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <h4 class="font-semibold text-gray-800">Location</h4>
                        </div>
                        <p class="text-gray-600">{{ $destination->place }}</p>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h4 class="font-semibold text-gray-800">Package Price</h4>
                        </div>
                        <p class="text-2xl font-bold text-green-600">Rp.
                            {{ number_format((float) $destination->price, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Duration/Time Section -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-purple-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h4 class="font-semibold text-gray-800">Duration</h4>
                        </div>
                        <p class="text-gray-600">{{ $destination->time }}</p>
                    </div>

                    <!-- Facilities Section -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            <h4 class="font-semibold text-gray-800">Facilities</h4>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach(explode(',', $destination->facility) as $facility)
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800">
                                    {{ trim($facility) }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <label class="block text-xs font-medium text-gray-500 mb-1">Created</label>
                            <p class="text-sm text-gray-700">{{ $destination->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <label class="block text-xs font-medium text-gray-500 mb-1">Last Updated</label>
                            <p class="text-sm text-gray-700">{{ $destination->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 mt-6 border-t border-gray-100 space-x-3">
                <button type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 "
                    data-modal-toggle="view-modal-{{ $destination->destination_id }}">
                    Close
                </button>
                <button type="button"
                    class="px-5 py-2.5 text-sm font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 "
                    onclick="window.open('{{ asset($destination->destination_photo) }}', '_blank')">
                    View Full Image
                </button>
            </div>
        </div>
    </div>
</div>