<div class="relative w-full max-w-7xl px-4 slide-down">
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Destination Overview</h3>
                <p class="text-sm text-gray-500 mt-1">Detailed summary in compact layout</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="view-modal-{{ $destination->destination_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6 space-y-6">
            <!-- Hero & Image Side-by-Side -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Hero Info -->
                <div class="lg:col-span-1 space-y-5">
                    <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-6 rounded-2xl text-white shadow-lg">
                        <h2 class="text-2xl font-bold mb-1">{{ $destination->name_package }}</h2>
                        <p class="text-blue-100 text-sm">{{ $destination->place }}</p>
                        <div class="mt-4">
                            <span
                                class="text-3xl font-extrabold">Rp.{{ number_format((float) $destination->price, 0, ',', '.') }}</span>
                            <span class="text-blue-200 block text-sm mt-1">/ person</span>
                        </div>
                        <div class="mt-3 text-xs bg-white bg-opacity-20 inline-block px-3 py-1 rounded-full">
                            {{ $destination->time }}
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <label class="block font-medium text-gray-500">Created</label>
                            <p class="text-gray-700">{{ $destination->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <label class="block font-medium text-gray-500">Updated</label>
                            <p class="text-gray-700">{{ $destination->updated_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="lg:col-span-2 rounded-xl overflow-hidden shadow-lg border border-gray-200">
                    <img 
                        src="{{ asset($destination->destination_photo) }}" 
                        alt="{{ $destination->name_package }}"
                        class="w-full h-64 lg:h-80 object-cover"
                        onerror="this.src=''; this.alt='Image not found';"
                    >
                </div>
            </div>

            <!-- Description -->
            @if($destination->description)
                <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm">
                    <h4 class="font-semibold text-gray-800 text-sm mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Description
                    </h4>
                    <div class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                        {!! nl2br(e($destination->description)) !!}
                    </div>
                </div>
            @endif

            @php
                $tags = $destination->tag ? json_decode($destination->tag, true) : [];
                if (!is_array($tags)) $tags = [];
            @endphp

            @if(!empty($tags))
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <h4 class="font-semibold text-gray-800 text-sm mb-3">Tags</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            @php $tag = trim($tag); @endphp
                            @if($tag)
                                <span class="px-3 py-1 text-xs font-medium bg-indigo-100 text-indigo-800 rounded-full">
                                    {{ $tag }}
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Key Info Grid (Category, Level, Location, etc.) -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                @if($destination->category)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                        <div class="text-blue-600 font-medium text-xs uppercase tracking-wide">Category</div>
                        <div class="text-blue-900 font-semibold mt-1">{{ ucfirst($destination->category) }}</div>
                    </div>
                @endif

                @if($destination->level)
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
                        <div class="text-purple-600 font-medium text-xs uppercase tracking-wide">Level</div>
                        <div class="text-purple-900 font-semibold mt-1">{{ ucfirst($destination->level) }}</div>
                    </div>
                @endif

                <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                    <div class="text-green-600 font-medium text-xs uppercase tracking-wide">Duration</div>
                    <div class="text-green-900 font-semibold mt-1">{{ $destination->time }}</div>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
                    <div class="text-yellow-600 font-medium text-xs uppercase tracking-wide">Transport</div>
                    <div class="text-yellow-900 font-semibold mt-1">{{ $destination->transportation ?: '-' }}</div>
                </div>
            </div>

            <!-- Facilities Row (Horizontal Badges) -->
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <h4 class="font-semibold text-gray-800 text-sm mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Activities
                </h4>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $destination->activities ?? '') as $activity)
                        @if(trim($activity))
                            <span class="px-3 py-1 text-xs font-medium bg-indigo-100 text-indigo-800 rounded-full">
                                {{ trim($activity) }}
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Accommodation & Consumption -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($destination->accommodation)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-800 text-sm">Accommodation</h4>
                        <p class="text-sm text-blue-700 mt-1">{{ $destination->accommodation }}</p>
                    </div>
                @endif

                @if($destination->consumption)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <h4 class="font-semibold text-green-800 text-sm">Meals</h4>
                        <p class="text-sm text-green-700 mt-1">{{ $destination->consumption }}</p>
                    </div>
                @endif
            </div>

            <!-- Pickup & Dropoff Points -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($destination->pickup_points)
                    <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4">
                        <h4 class="font-semibold text-emerald-800 text-sm">Pickup Points</h4>
                        <p class="text-sm text-emerald-700 mt-1">
                            @foreach(json_decode($destination->pickup_points, true) ?? [$destination->pickup_points] as $point)
                                {{ trim($point) }}@unless($loop->last), @endunless
                            @endforeach
                        </p>
                    </div>
                @endif

                @if($destination->dropoff_points)
                    <div class="bg-rose-50 border border-rose-200 rounded-lg p-4">
                        <h4 class="font-semibold text-rose-800 text-sm">Dropoff Points</h4>
                        <p class="text-sm text-rose-700 mt-1">
                            @foreach(json_decode($destination->dropoff_points, true) ?? [$destination->dropoff_points] as $point)
                                {{ trim($point) }}@unless($loop->last), @endunless
                            @endforeach
                        </p>
                    </div>
                @endif
            </div>

            <!-- Include & Exclude Side by Side -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if($destination->include)
                    <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-5">
                        <h4 class="font-semibold text-emerald-800 text-sm mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Included
                        </h4>
                        <ul class="space-y-1">
                            @foreach(explode("\n", $destination->include) as $item)
                                @if(trim($item))
                                    <li class="text-xs text-emerald-700 flex items-center">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-2"></span>
                                        {{ trim($item) }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($destination->exclude)
                    <div class="bg-rose-50 border border-rose-200 rounded-lg p-5">
                        <h4 class="font-semibold text-rose-800 text-sm mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Excluded
                        </h4>
                        <ul class="space-y-1">
                            @foreach(explode("\n", $destination->exclude) as $item)
                                @if(trim($item))
                                    <li class="text-xs text-rose-700 flex items-center">
                                        <span class="w-1.5 h-1.5 bg-rose-500 rounded-full mr-2"></span>
                                        {{ trim($item) }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Note -->
            @if($destination->note)
                <div class="bg-amber-50 border border-amber-200 rounded-lg p-5">
                    <h4 class="font-semibold text-amber-800 text-sm mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Important Note
                    </h4>
                    <div class="text-sm text-amber-700 leading-relaxed whitespace-pre-line">
                        {!! nl2br(e($destination->note)) !!}
                    </div>
                </div>
            @endif

            <!-- Itinerary (Full Width) -->
            @if($destination->itinerary)
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-5">
                    <h4 class="font-semibold text-gray-800 text-sm mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7v8a2 2 0 002 2h6M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                        </svg>
                        Itinerary
                    </h4>
                    <div class="text-xs text-gray-700 leading-relaxed whitespace-pre-line">
                        {!! $destination->itinerary !!}
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex justify-end pt-4 border-t border-gray-100 space-x-3">
                <button type="button"
                    class="px-5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50"
                    data-modal-toggle="view-modal-{{ $destination->destination_id }}">
                    Close
                </button>
                <button type="button"
                    class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700"
                    onclick="window.open('{{ asset($destination->destination_photo) }}', '_blank')">
                    View Image
                </button>
            </div>
        </div>
    </div>
</div>