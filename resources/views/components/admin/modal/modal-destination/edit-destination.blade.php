<div class="relative w-full max-w-4xl px-4 slide-down overflow-y-auto" 
     x-data="{ 
        step: 1, 
        tiers: {{ $destination->price_tiers ? json_encode($destination->price_tiers) : '[{ min_pax: \'\', max_pax: \'\', price: \'\', description: \'\' }]' }} 
     }">
    
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Edit Destination: {{ $destination->name_package }}</h3>
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

                <input type="hidden" name="id" value="{{ $destination->destination_id }}">

                {{-- Stepper Navigation --}}
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

                {{-- STEP 1: Basic Information --}}
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

                {{-- STEP 2: Pricing & Tiers (UPDATED with Dynamic Tiers + Description) --}}
                <div x-show="step === 2" class="space-y-6">
                    
                    {{-- Basic Price & Duration --}}
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium">Base Price (Per Person)</label>
                            <input type="text" name="price" placeholder="Rp 1.500.000"
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 price-input"
                                value="{{ old('price', $destination->price) }}">
                            <p class="text-xs text-gray-400 mt-1">Standard price for single pax or base rate.</p>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium">Duration</label>
                            <input type="text" name="time" placeholder="3 Days 2 Nights"
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                                value="{{ old('time', $destination->time) }}" required>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Dynamic Price Tiers Section --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium">Price Tiers (Group Pricing)</label>
                        <p class="text-xs text-gray-400 mb-3">Set different prices based on group size.</p>
                        
                        <div class="space-y-3">
                            <template x-for="(tier, index) in tiers" :key="index">
                                <div class="flex flex-col md:flex-row items-end gap-3 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <div class="w-full md:w-20">
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Min Pax</label>
                                        <input type="number" :name="`price_tiers[${index}][min_pax]`" x-model="tier.min_pax" placeholder="e.g. 2"
                                            class="w-full border rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div class="w-full md:w-20">
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Max Pax</label>
                                        <input type="number" :name="`price_tiers[${index}][max_pax]`" x-model="tier.max_pax" placeholder="e.g. 5"
                                            class="w-full border rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div class="w-full md:w-40">
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Price (IDR)</label>
                                        <input type="text" :name="`price_tiers[${index}][price]`" x-model="tier.price" placeholder="Rp 1.000.000"
                                            class="w-full border rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    {{-- Kolom Keterangan Baru --}}
                                    <div class="w-full md:flex-1">
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Description (Optional)</label>
                                        <input type="text" :name="`price_tiers[${index}][description]`" x-model="tier.description" placeholder="e.g. Include Lunch / Special Discount"
                                            class="w-full border rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    
                                    {{-- Tombol Hapus (Sampah) --}}
                                    <div class="pb-1">
                                        <button type="button" @click="tiers.splice(index, 1)" 
                                                class="text-red-500 hover:text-red-700 hover:bg-red-100 p-2 rounded-md transition-colors"
                                                title="Remove Tier">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>

                        {{-- Tombol Tambah (+) --}}
                        <button type="button" @click="tiers.push({ min_pax: '', max_pax: '', price: '', description: '' })"
                            class="mt-3 flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 px-4 py-2 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add New Price Tier
                        </button>
                    </div>
                    
                    {{-- Policy & Description --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium">WNA/WNI Policy</label>
                        <select name="wna_wni_policy"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Select Policy --</option>
                            <option value="WNI" {{ old('wna_wni_policy', $destination->wna_wni_policy) == 'WNI' ? 'selected' : '' }}>WNI (Warga Negara Indonesia)</option>
                            <option value="WNA" {{ old('wna_wni_policy', $destination->wna_wni_policy) == 'WNA' ? 'selected' : '' }}>WNA (Warga Negara Asing)</option>
                            <option value="All" {{ old('wna_wni_policy', $destination->wna_wni_policy) == 'All' ? 'selected' : '' }}>All (WNI & WNA)</option>
                        </select>
                        <p class="text-xs text-gray-400 mt-1">Determines which pricing applies or if both are accepted.</p>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium">Description</label>
                        <textarea name="description" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('description', $destination->description) }}</textarea>
                    </div>
                </div>

                {{-- STEP 3: Logistics --}}
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
                    <div>
                        <label class="block mb-2 text-sm font-medium">Accommodation</label>
                        <input type="text" name="accommodation" placeholder="4-Star Hotel / Villa"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('accommodation', $destination->accommodation) }}">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Consumption (Meals)</label>
                        <input type="text" name="consumption" placeholder="Breakfast, Lunch, Dinner"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('consumption', $destination->consumption) }}">
                    </div>
                </div>

                {{-- STEP 4: Activities & Tags --}}
                <div x-show="step === 4" class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Activities</label>
                        <input type="text" name="activities" placeholder="Snorkeling, Trekking, Diving"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            value="{{ old('activities', $destination->activities) }}">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium">Tags (Optional)</label>
                        <div class="border rounded-lg p-3 focus-within:ring-2 focus-within:ring-blue-500 bg-white">
                            {{-- Unique ID for tag container based on destination ID --}}
                            <div id="tags-container-edit-{{ $destination->destination_id }}" class="flex flex-wrap gap-2 mb-2 min-h-10">
                                @if(!empty($destination->tag))
                                    @foreach(explode(',', $destination->tag) as $tag)
                                        @if(trim($tag))
                                            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                                {{ trim($tag) }}
                                                <button type="button" 
                                                    onclick="removeEditTag(this, '{{ $destination->destination_id }}')" 
                                                    class="ml-1 text-blue-600 hover:text-blue-800">×</button>
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
                                        const span = document.createElement('span');
                                        span.className = 'inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full';
                                        span.innerHTML = val + '<button type=\'button\' onclick=\'removeEditTag(this, \"{{ $destination->destination_id }}\")\' class=\'ml-1 text-blue-600 hover:text-blue-800\'>×</button>';
                                        document.getElementById('tags-container-edit-{{ $destination->destination_id }}').appendChild(span);
                                        updateEditTagInput('{{ $destination->destination_id }}');
                                        $event.target.value = '';
                                    }
                                "
                            >
                            <input type="hidden" name="tag" id="tag-hidden-input-edit-{{ $destination->destination_id }}" value="{{ old('tag', $destination->tag) ?? '' }}">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Press Enter to add a tag. E.g.: Bali, Beach, Romantic</p>
                    </div>
                </div>

                {{-- STEP 5: Inclusions --}}
                <div x-show="step === 5" class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Include</label>
                        <textarea name="include" rows="4" placeholder="Accommodation. Meals. Transport..."
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('include', $destination->include) }}</textarea>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Exclude</label>
                        <textarea name="exclude" rows="4" placeholder="Personal expenses. Tips. Insurance..."
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('exclude', $destination->exclude) }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium">Note (Optional)</label>
                        <input 
                            id="note-{{ $destination->destination_id }}" 
                            type="hidden" 
                            name="note" 
                            value="{{ old('note', $destination->note) }}"
                        >
                        <trix-editor 
                            input="note-{{ $destination->destination_id }}"
                            class="border border-gray-300 rounded-lg bg-white"
                            style="max-height: 200px; overflow-y: auto;"
                        ></trix-editor>
                        <p class="text-xs text-gray-400 mt-1">Use this to provide extra information for customers.</p>
                    </div>
                </div>

                {{-- STEP 6: Itinerary & Photos --}}
                <div x-show="step === 6" class="grid gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Itinerary</label>
                        <input 
                            id="itinerary-{{ $destination->destination_id }}" 
                            type="hidden" 
                            name="itinerary" 
                            value="{{ old('itinerary', $destination->itinerary) }}"
                        >
                        <trix-editor 
                            input="itinerary-{{ $destination->destination_id }}"
                            class="border border-gray-300 rounded-lg bg-white"
                            style="max-height: 200px; overflow-y: auto;"
                        ></trix-editor>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        @php
                            $photoFields = [
                                'destination_photo' => 'Photo 1 (Main) Landscape',
                                'destination_photo_2' => 'Photo 2 Potrait',
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
                                    data-preview="edit-preview-{{ $destination->destination_id }}-{{ $field }}"
                                    class="w-full border rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500"
                                    onchange="handleEditImageChange(event, 'edit-preview-{{ $destination->destination_id }}-{{ $field }}', 'edit-remove-checkbox-{{ $destination->destination_id }}-{{ $field }}')"
                                    {{ $field == 'destination_photo' && empty($destination->destination_photo) ? 'required' : '' }}
                                >
                                <p class="text-xs text-gray-400 mt-1">Upload image (jpg, png, max 2MB). Leave empty to keep current.</p>

                                <div class="mt-4 flex flex-col items-center">
                                    <div class="w-full h-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center overflow-hidden">
                                        @php
                                            $photoUrl = !empty($destination->{$field}) ? Storage::url($destination->{$field}) : '';
                                        @endphp

                                        <img 
                                            id="edit-preview-{{ $destination->destination_id }}-{{ $field }}" 
                                            src="{{ $photoUrl }}" 
                                            alt="Preview"
                                            data-initial-src="{{ $photoUrl }}"
                                            class="w-full h-24 object-cover rounded-lg {{ $photoUrl ? 'block' : 'hidden' }}"
                                        >
                                        <span
                                            id="placeholder-edit-preview-{{ $destination->destination_id }}-{{ $field }}"
                                            class="text-gray-400 text-sm {{ $photoUrl ? 'hidden' : 'block' }}">
                                            Image Preview
                                        </span>
                                    </div>
                                    
                                    @if (!empty($destination->{$field}))
                                        <div class="mt-2 flex items-center">
                                            <input type="checkbox" name="remove_photo[]" value="{{ $field }}"
                                                id="edit-remove-checkbox-{{ $destination->destination_id }}-{{ $field }}"
                                                class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500"
                                                onchange="toggleEditImagePreview(this, 'edit-preview-{{ $destination->destination_id }}-{{ $field }}')">
                                            <label for="edit-remove-checkbox-{{ $destination->destination_id }}-{{ $field }}"
                                                class="ml-2 text-sm font-medium text-gray-700">
                                                Remove current image
                                            </label>
                                        </div>
                                    @endif
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
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // --- Tag Management Functions for EDIT ---
    window.updateEditTagInput = function(destinationId) {
        const containerId = 'tags-container-edit-' + destinationId;
        const hiddenInputId = 'tag-hidden-input-edit-' + destinationId;
        
        const container = document.getElementById(containerId);
        const tags = Array.from(container.children)
            .map(span => span.textContent.trim().replace('×', '').trim())
            .filter(tag => tag !== "");

        const hiddenInput = document.getElementById(hiddenInputId);
        if (hiddenInput) {
            hiddenInput.value = tags.join(', ');
        }
    }

    window.removeEditTag = function(button, destinationId) {
        const span = button.parentNode;
        const container = span.parentNode;
        container.removeChild(span);
        updateEditTagInput(destinationId);
    }

    // --- Image Preview Functions for EDIT (Multiple Photos) ---
    window.handleEditImageChange = function(event, previewId, removeCheckboxId) {
        const file = event.target.files[0];
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById('placeholder-' + previewId);
        const removeCheckbox = document.getElementById(removeCheckboxId);
        
        if (!preview.dataset.initialSrc) {
            preview.dataset.initialSrc = preview.src;
        }

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);

            if (removeCheckbox) {
                removeCheckbox.checked = false;
            }
        } else {
            const initialSrc = preview.dataset.initialSrc || '';
            if (initialSrc) {
                preview.src = initialSrc;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                preview.src = '';
                preview.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }

            if (removeCheckbox) {
                removeCheckbox.checked = false;
            }
        }
    }

    window.toggleEditImagePreview = function(checkbox, previewId) {
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById('placeholder-' + previewId);
        const initialSrc = preview.dataset.initialSrc || '';
        
        if (checkbox.checked) {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        } else {
            if (initialSrc) { 
                preview.src = initialSrc;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                preview.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('img[id^="edit-preview-"]').forEach(img => {
            if (img.src && img.src.includes('storage')) {
                img.setAttribute('data-initial-src', img.src);
            }
        });
        
        const editFormId = '{{ $destination->destination_id }}';
        updateEditTagInput(editFormId);
    });
</script>