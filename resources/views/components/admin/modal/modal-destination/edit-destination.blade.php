<div class="relative w-full max-w-4xl px-4 slide-down" x-data="{ step: 1 }">
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Edit Destination</h3>
                <p class="text-sm text-gray-500 mt-1">Update travel package details step by step</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="edit-modal-{{ $destination->destination_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-8">
            <form id="edit-form-{{ $destination->destination_id }}" enctype="multipart/form-data"
                action="{{ route('manage-destination.update', $destination->destination_id) }}" method="POST"
                class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Hidden ID -->
                <input type="hidden" name="id" value="{{ $destination->destination_id }}">

                <!-- Progress indicator -->
                <div class="flex justify-center mb-8">
                    <div class="flex items-center space-x-4">
                        <template x-for="i in 6" :key="i">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full font-medium"
                                    :class="step >= i ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500'">
                                    <span x-text="i"></span>
                                </div>
                                <template x-if="i < 6">
                                    <div class="w-12 h-1" :class="step > i ? 'bg-blue-600' : 'bg-gray-300'">
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- STEP 1: Basic Info -->
                <div x-show="step === 1" class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Name Package</label>
                        <input type="text" name="name_package" placeholder="Example: Bali Adventure Trip"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('name_package', $destination->name_package) }}" required>
                        <p class="text-xs text-gray-400 mt-1">Enter a unique name for this package</p>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Place</label>
                        <input type="text" name="place" placeholder="Bali, Indonesia"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('place', $destination->place) }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Category</label>
                        <input type="text" name="category" placeholder="Adventure / Family / Romantic"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('category', $destination->category) }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Level</label>
                        <input type="text" name="level" placeholder="Easy / Medium / Hard"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('level', $destination->level) }}">
                    </div>
                </div>

                <!-- STEP 2: Pricing & Time -->
                <div x-show="step === 2" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium">Price</label>
                            <input type="text" name="price" placeholder="Rp 1.500.000"
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 price-input"
                                value="{{ old('price', number_format((float) $destination->price, 0, ',', '.')) }}">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium">Duration</label>
                            <input type="text" name="time" placeholder="3 Days 2 Nights"
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                                value="{{ old('time', $destination->time) }}" required>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Description</label>
                        <textarea name="description" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ $destination->description }}</textarea>
                    </div>
                </div>

                <!-- STEP 3: Location & Transport -->
                <div x-show="step === 3" class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Pickup Points</label>
                        <input type="text" name="pickup_points" placeholder="Ngurah Rai Airport"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('pickup_points', $destination->pickup_points) }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Dropoff Points</label>
                        <input type="text" name="dropoff_points" placeholder="Hotel / Villa"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('dropoff_points', $destination->dropoff_points) }}">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium">Transportation</label>
                        <input type="text" name="transportation" placeholder="Bus / Car / Boat"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('transportation', $destination->transportation) }}">
                    </div>
                </div>

                <!-- STEP 4: Facilities -->
                <div x-show="step === 4" class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Activities</label>
                        <input type="text" name="activities" placeholder="Snorkeling, Trekking, Diving"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('activities', $destination->activities) }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Accommodation</label>
                        <input type="text" name="accommodation" placeholder="4-Star Hotel / Villa"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('accommodation', $destination->accommodation) }}">
                    </div>
                    <!-- Di dalam form, pastikan input tag menggunakan name="tag[]" -->
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium">Tags (Optional)</label>
                        <div class="border rounded-lg p-3 focus-within:ring-2 focus-within:ring-blue-500 bg-white">
                            <div id="tags-container-edit-{{ $destination->destination_id }}" class="flex flex-wrap gap-2 mb-2 min-h-10">
                                <!-- Tampilkan tag yang sudah ada -->
                                @if(!empty($destination->tag))
                                    @foreach(explode(',', $destination->tag) as $tag)
                                        @if(trim($tag))
                                            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                                {{ trim($tag) }}
                                                <button type="button" onclick="removeTag(this)" class="ml-1 text-blue-600 hover:text-blue-800">×</button>
                                            </span>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <input
                                type="text"
                                id="tag-input-edit-{{ $destination->destination_id }}"
                                placeholder="Type a tag and press Enter..."
                                class="w-full outline-none"
                                @keydown.enter.prevent="
                                    const val = $event.target.value.trim();
                                    if (val) {
                                        // Tambahkan tag ke container yang terlihat
                                        const span = document.createElement('span');
                                        span.className = 'inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full';
                                        span.innerHTML = val + '<button type=\'button\' onclick=\'removeTag(this)\' class=\'ml-1 text-blue-600 hover:text-blue-800\'>×</button>';
                                        document.getElementById('tags-container-edit-{{ $destination->destination_id }}').appendChild(span);

                                        // Update input hidden dengan semua tag
                                        updateEditTagInput('{{ $destination->destination_id }}');

                                        $event.target.value = '';
                                    }
                                "
                            >
                            <!-- Input hidden untuk menyimpan semua tag sebagai string -->
                            <input type="hidden" name="tag" id="tag-hidden-input-edit-{{ $destination->destination_id }}" value="{{ $destination->tag ?? '' }}">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Press Enter to add a tag. E.g.: Bali, Beach, Romantic</p>
                    </div>
                </div>

                <!-- STEP 5: Package Content -->
                <div x-show="step === 5" class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Include</label>
                        <textarea name="include" rows="4" placeholder="Accommodation, Meals, Transport..."
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('include', $destination->include) }}</textarea>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Exclude</label>
                        <textarea name="exclude" rows="4" placeholder="Personal expenses, Tips, Insurance..."
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('exclude', $destination->exclude) }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium">Note (Optional)</label>
                        <textarea name="note" rows="3" placeholder="Additional notes for travelers, e.g., visa requirements, weather tips, etc."
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('note', $destination->note) }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Use this to provide extra information for customers.</p>
                    </div>
                </div>

                <!-- STEP 6: Itinerary & Photo -->
                <div x-show="step === 6" class="grid gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Itinerary</label>
                        <input id="itinerary" type="hidden" name="itinerary" value="{{ old('itinerary', $destination->itinerary) }}">
                        <trix-editor 
                            input="itinerary"
                            class="border border-gray-300 rounded-lg bg-white"
                            style="min-height: 200px;"
                        ></trix-editor>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Destination Photo</label>
                        <input 
                            type="file" 
                            name="destination_photo" 
                            accept="image/*"
                            data-original-src="{{ asset($destination->destination_photo) }}"
                            data-preview="edit-preview-photo-{{ $destination->destination_id }}"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                        >
                        <p class="text-xs text-gray-400 mt-1">Upload a new image (jpg, png, max 2MB). Leave empty to keep current.</p>

                        <!-- Preview Container -->
                        <div class="mt-4 flex flex-col items-center">
                            <div class="w-full h-48 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center">
                                <img 
                                    id="edit-preview-photo-{{ $destination->destination_id }}" 
                                    src="{{ asset($destination->destination_photo) }}" 
                                    alt="Preview" 
                                    class="w-full h-full object-cover rounded-lg"
                                    onerror="this.src=''; this.alt='Image not found';"
                                >
                            </div>
                        </div>

                        @if($destination->destination_photo)
                            <p class="mt-2 text-sm text-gray-500">
                                Current: <a href="{{ asset($destination->destination_photo) }}" target="_blank"
                                    class="text-blue-600 hover:underline">View Current Image</a>
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Navigation buttons -->
                <div class="flex justify-between pt-8 border-t mt-8 border-gray-100">
                    <button type="button" @click="step = Math.max(step - 1, 1)" x-show="step > 1"
                        class="px-6 py-3 text-sm font-medium bg-gray-200 rounded-lg hover:bg-gray-300">Previous</button>

                    <div class="ml-auto">
                        <button type="button" @click="step = step + 1" x-show="step < 6"
                            class="px-6 py-3 text-sm font-medium bg-blue-600 text-white rounded-lg hover:bg-blue-700">Next</button>

                        <button type="submit" x-show="step === 6"
                            class="px-6 py-3 text-sm font-medium bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>