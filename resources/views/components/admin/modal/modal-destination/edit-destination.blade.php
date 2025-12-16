<div class="relative w-full max-w-4xl px-4 slide-down overflow-y-auto" x-data="{ step: 1 }">
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

                <div x-show="step === 2" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-3">
                        <div>
                            <label class="block mb-2 text-sm font-medium">Price (WNI/Normal)</label>
                            <input type="text" 
                                name="price" 
                                placeholder="Rp 1.500.000"
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 price-input"
                                value="{{ old('price', $destination->price) }}"
                            >
                            <p class="text-xs text-gray-400 mt-1">Price for Indonesian citizens/standard price.</p>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium">Price 2 (WNA/Optional)</label>
                            <input type="text" 
                                name="price_2" 
                                placeholder="Rp 2.000.000"
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 price-input"
                                value="{{ old('price_2', $destination->price_2) }}"
                            >
                            <p class="text-xs text-gray-400 mt-1">Price for Foreigners (if applicable).</p>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium">Duration</label>
                            <input type="text" name="time" placeholder="3 Days 2 Nights"
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                                value="{{ old('time', $destination->time) }}" required>
                        </div>
                    </div>
                    
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
                                        // Tambahkan tag ke container yang terlihat
                                        const span = document.createElement('span');
                                        span.className = 'inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full';
                                        span.innerHTML = val + '<button type=\'button\' onclick=\'removeEditTag(this, \"{{ $destination->destination_id }}\")\' class=\'ml-1 text-blue-600 hover:text-blue-800\'>×</button>';
                                        document.getElementById('tags-container-edit-{{ $destination->destination_id }}').appendChild(span);

                                        // Update input hidden dengan semua tag
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
                                        {{-- Cek apakah ada foto di database, jika ya tampilkan --}}
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
                                    
                                    {{-- Checkbox Hapus Foto --}}
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

    // Fungsi untuk mendapatkan semua tag dari container dan mengupdate hidden input
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

    // Fungsi untuk menghapus tag
    window.removeEditTag = function(button, destinationId) {
        const span = button.parentNode;
        const container = span.parentNode;
        container.removeChild(span);

        // Update hidden input setelah penghapusan
        updateEditTagInput(destinationId);
    }

    // --- Image Preview Functions for EDIT (Multiple Photos) ---

    // Fungsi untuk mengubah tampilan preview gambar
    window.handleEditImageChange = function(event, previewId, removeCheckboxId) {
        const file = event.target.files[0];
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById('placeholder-' + previewId);
        const removeCheckbox = document.getElementById(removeCheckboxId);
        
        // Simpan src awal jika belum ada
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

            // Jika ada file baru diupload, pastikan checkbox "Remove" tidak dicentang
            if (removeCheckbox) {
                removeCheckbox.checked = false;
            }
        } else {
            // Jika input dikosongkan (cancel selection)
            const initialSrc = preview.dataset.initialSrc || '';
            if (initialSrc) {
                // Tampilkan gambar lama
                preview.src = initialSrc;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                // Tidak ada gambar lama, sembunyikan preview
                preview.src = '';
                preview.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }

            if (removeCheckbox) {
                removeCheckbox.checked = false;
            }
        }
    }

    // Fungsi untuk toggle preview saat checkbox "Remove" dicentang
    window.toggleEditImagePreview = function(checkbox, previewId) {
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById('placeholder-' + previewId);
        const initialSrc = preview.dataset.initialSrc || '';
        
        if (checkbox.checked) {
            // Jika Remove dicentang, sembunyikan preview
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        } else {
            // Jika Remove tidak dicentang, tampilkan gambar lama (jika ada)
            if (initialSrc) { 
                preview.src = initialSrc;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                 // Tidak ada gambar lama, biarkan placeholder
                preview.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }
        }
    }

    // Inisialisasi Data Source saat DOM Loaded (diperlukan untuk logika hapus/reset)
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('img[id^="edit-preview-"]').forEach(img => {
            if (img.src && img.src.includes('storage')) {
                img.setAttribute('data-initial-src', img.src);
            }
        });
        
        // Inisialisasi Tag Input
        const editFormId = '{{ $destination->destination_id }}';
        const containerId = 'tags-container-edit-' + editFormId;
        
        if (document.getElementById(containerId)) {
             // Pastikan hidden input mencerminkan data awal (dari blade/php)
            updateEditTagInput(editFormId);
        }
    });
</script>