<div class="relative w-full max-w-4xl px-4 slide-down" x-data="{ step: 1 }">
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Add Destination</h3>
                <p class="text-sm text-gray-500 mt-1">Complete each step to add a new travel package</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                    data-modal-toggle="add-modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-8">
            <form id="add-form" enctype="multipart/form-data" action="{{ route('manage-destination.store') }}"
                  method="POST" class="space-y-8">
                @csrf

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
                                    <div class="w-12 h-1" :class="step > i ? 'bg-blue-600' : 'bg-gray-300'"></div>
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
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                        <p class="text-xs text-gray-400 mt-1">Enter a unique name for this package</p>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Place</label>
                        <input type="text" name="place" placeholder="Bali, Indonesia"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Category</label>
                        <input type="text" name="category" placeholder="Adventure / Family / Romantic"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Level</label>
                        <input type="text" name="level" placeholder="Easy / Medium / Hard"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- STEP 2: Pricing & Time -->
                <div x-show="step === 2" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium">Price</label>
                            <input type="text" name="price" placeholder="Rp 1.500.000"
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium">Duration</label>
                            <input type="text" name="time" placeholder="3 Days 2 Nights"
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Description</label>
                        <textarea name="description" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                </div>

                <!-- STEP 3: Location & Transport -->
                <div x-show="step === 3" class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Pickup Points</label>
                        <input type="text" name="pickup_points" placeholder="Ngurah Rai Airport"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Dropoff Points</label>
                        <input type="text" name="dropoff_points" placeholder="Hotel / Villa"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium">Transportation</label>
                        <input type="text" name="transportation" placeholder="Bus / Car / Boat"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- STEP 4: Facilities & Tags -->
                <div x-show="step === 4" class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Activities</label>
                        <input type="text" name="activities" placeholder="Snorkeling, Trekking, Diving"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Accommodation</label>
                        <input type="text" name="accommodation" placeholder="4-Star Hotel / Villa"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium">Tags (Optional)</label>
                        <div class="border rounded-lg p-3 focus-within:ring-2 focus-within:ring-blue-500 bg-white">
                            <div id="tags-container-add" class="flex flex-wrap gap-2 mb-2 min-h-10"></div>
                            <input
                                type="text"
                                id="tag-input-add"
                                placeholder="Type a tag and press Enter..."
                                class="w-full outline-none"
                                @keydown.enter.prevent="
                                    const val = $event.target.value.trim();
                                    if (val) {
                                        // Tambahkan tag ke container yang terlihat
                                        const span = document.createElement('span');
                                        span.className = 'inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full';
                                        span.innerHTML = val + '<button type=\'button\' onclick=\'removeTag(this)\' class=\'ml-1 text-blue-600 hover:text-blue-800\'>×</button>';
                                        document.getElementById('tags-container-add').appendChild(span);

                                        // Update input hidden dengan semua tag
                                        updateTagInput();

                                        $event.target.value = '';
                                    }
                                "
                            >
                            <!-- Input hidden untuk menyimpan semua tag sebagai string -->
                            <input type="hidden" name="tag" id="tag-hidden-input" value="">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Press Enter to add a tag. E.g.: Bali, Beach, Romantic</p>
                    </div>
                </div>

                <!-- STEP 5: Include, Exclude & Note -->
                <div x-show="step === 5" class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Include</label>
                        <textarea name="include" rows="4" placeholder="Accommodation. Meals. Transport..."
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Exclude</label>
                        <textarea name="exclude" rows="4" placeholder="Personal expenses. Tips. Insurance..."
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium">Note (Optional)</label>
                        <input id="note-add" type="hidden" name="note">
                        <trix-editor input="note-add" class="border border-gray-300 rounded-lg bg-white"
                                     style="max-height: 200px;"></trix-editor>
                        <p class="text-xs text-gray-400 mt-1">Use this to provide extra information for customers.</p>
                    </div>
                </div>

                <!-- STEP 6: Itinerary & Photo -->
                <div x-show="step === 6" class="grid gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Itinerary</label>
                        <input id="itinerary-add" type="hidden" name="itinerary">
                        <trix-editor input="itinerary-add" class="border border-gray-300 rounded-lg bg-white"
                                     style="max-height: 200px;"></trix-editor>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Destination Photo</label>
                        <input type="file" name="destination_photo" accept="image/*"
                               data-preview="add-preview-photo"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-400 mt-1">Upload a representative image (jpg, png, max 2MB)</p>

                        <div class="mt-4 flex flex-col items-center">
                            <div class="w-full h-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center">
                                <img id="add-preview-photo" src="" alt="Preview"
                                     class="w-full h-full object-cover rounded-lg hidden">
                                <span id="placeholder-add-preview-photo" class="text-gray-400 text-sm">Image Preview</span>
                            </div>
                        </div>
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
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>