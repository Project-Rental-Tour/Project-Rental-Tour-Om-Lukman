<div class="relative w-full max-w-4xl px-4 slide-down" x-data="{ step: 1 }">
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
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

                <div x-show="step === 2" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-3">
                        <div>
                            <label class="block mb-2 text-sm font-medium">Price (WNI/Normal)</label>
                            <input type="text" name="price" placeholder="Rp 1.500.000"
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            <p class="text-xs text-gray-400 mt-1">Price for Indonesian citizens/standard price.</p>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium">Price 2 (WNA/Optional)</label>
                            <input type="text" name="price_2" placeholder="Rp 2.000.000"
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            <p class="text-xs text-gray-400 mt-1">Price for Foreigners (if applicable).</p>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium">Duration</label>
                            <input type="text" name="time" placeholder="3 Days 2 Nights"
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">WNA/WNI Policy</label>
                        <select name="wna_wni_policy"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Select Policy --</option>
                            <option value="WNI">WNI (Warga Negara Indonesia)</option>
                            <option value="WNA">WNA (Warga Negara Asing)</option>
                            <option value="All">All (WNI & WNA)</option>
                        </select>
                        <p class="text-xs text-gray-400 mt-1">Determines which pricing applies or if both are accepted.</p>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Description</label>
                        <textarea name="description" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                </div>

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
                    <div>
                        <label class="block mb-2 text-sm font-medium">Accommodation</label>
                        <input type="text" name="accommodation" placeholder="4-Star Hotel / Villa"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Consumption (Meals)</label>
                        <input type="text" name="consumption" placeholder="Breakfast, Lunch, Dinner"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div x-show="step === 4" class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Activities</label>
                        <input type="text" name="activities" placeholder="Snorkeling, Trekking, Diving"
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
                            <input type="hidden" name="tag" id="tag-hidden-input" value="">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Press Enter to add a tag. E.g.: Bali, Beach, Romantic</p>
                    </div>
                </div>

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
                        <input id="note-add" type="hidden" name="note" class="overflow-y-auto">
                        <trix-editor input="note-add" class="border border-gray-300 rounded-lg bg-white overflow-y-auto"
                                     style="max-height: 200px;"></trix-editor>
                        <p class="text-xs text-gray-400 mt-1">Use this to provide extra information for customers.</p>
                    </div>
                </div>

                <div x-show="step === 6" class="grid gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Itinerary</label>
                        <input id="itinerary-add" type="hidden" name="itinerary" class="overflow-y-auto">
                        <trix-editor input="itinerary-add" class="border border-gray-300 rounded-lg bg-white overflow-y-auto"
                                    style="max-height: 200px;"></trix-editor>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        @php
                            $photoFields = [
                                'destination_photo' => 'Photo 1 (Main)',
                                'destination_photo_2' => 'Photo 2',
                                'destination_photo_3' => 'Photo 3',
                                'destination_photo_4' => 'Photo 4',
                            ];
                        @endphp
                        
                        @foreach ($photoFields as $field => $label)
                            <div>
                                <label class="block mb-2 text-sm font-medium">{{ $label }}</label>
                                <input 
                                    type="file" 
                                    name="{{ $field }}" 
                                    accept="image/*"
                                    data-preview="add-preview-{{ $field }}"
                                    class="w-full border rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500"
                                    onchange="handleImageChange(event, 'add-preview-{{ $field }}')"
                                    {{ $field == 'destination_photo' ? 'required' : '' }}>
                                
                                <p class="text-xs text-gray-400 mt-1">Upload image (jpg, png, max 2MB). Main photo is required.</p>

                                <div class="mt-4 flex flex-col items-center">
                                    <div class="w-full h-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center overflow-hidden">
                                        <img 
                                            id="add-preview-{{ $field }}" 
                                            src="" 
                                            alt="Preview"
                                            class="w-full h-24 object-cover rounded-lg hidden"
                                        >
                                        <span 
                                            id="placeholder-add-preview-{{ $field }}" 
                                            class="text-gray-400 text-sm"
                                        >
                                            Image Preview
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

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

<script>
    // --- Tag Management Functions (Sesuai dengan modal Add) ---

    // Fungsi untuk mendapatkan semua tag dari container dan mengupdate hidden input
    window.updateTagInput = function() {
        const container = document.getElementById('tags-container-add');
        const tags = Array.from(container.children)
            .map(span => span.textContent.trim().replace('×', '').trim())
            .filter(tag => tag !== "");

        const hiddenInput = document.getElementById('tag-hidden-input');
        if (hiddenInput) {
            hiddenInput.value = tags.join(', ');
        }
    }

    // Fungsi untuk menghapus tag
    window.removeTag = function(button) {
        const span = button.parentNode;
        const container = span.parentNode;
        container.removeChild(span);

        // Update hidden input setelah penghapusan
        updateTagInput();
    }


    // --- Image Preview Functions ---
    
    // Menggunakan fungsi yang dimodifikasi agar kompatibel dengan Add (tanpa remove checkbox)
    window.handleImageChange = function(event, previewId) {
        const file = event.target.files[0];
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById('placeholder-' + previewId);

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            // Jika input dikosongkan (cancel selection), sembunyikan preview dan tampilkan placeholder
            preview.src = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    }
</script>