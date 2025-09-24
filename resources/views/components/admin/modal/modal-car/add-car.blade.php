<div class="relative w-full max-w-4xl px-4 slide-down" x-data="{ step: 1 }">
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Add New Car</h3>
                <p class="text-sm text-gray-500 mt-1">Complete each step to add a new car to your fleet</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                    data-modal-toggle="add-car-modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-8">
            <form id="add-car-form" enctype="multipart/form-data" action="{{ route('manage-car.store') }}"
                  method="POST" class="space-y-8">
                @csrf

                <!-- Progress indicator -->
                <div class="flex justify-center mb-8">
                    <div class="flex items-center space-x-4">
                        <template x-for="i in 5" :key="i">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full font-medium"
                                     :class="step >= i ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500'">
                                    <span x-text="i"></span>
                                </div>
                                <template x-if="i < 5">
                                    <div class="w-12 h-1" :class="step > i ? 'bg-blue-600' : 'bg-gray-300'"></div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- STEP 1: Basic Info -->
                <div x-show="step === 1" class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Car Name</label>
                        <input type="text" name="name_car" placeholder="Example: Toyota Avanza"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                        <p class="text-xs text-gray-400 mt-1">Enter a unique name for this car</p>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Car Type</label>
                        <input type="text" name="car_type" placeholder="MPV / SUV / Sedan"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium">Description</label>
                        <textarea name="description" rows="3" placeholder="Describe the car features and specifications..."
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>
                </div>

                <!-- STEP 2: Specifications -->
                <div x-show="step === 2" class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Transmission</label>
                        <select name="transmission" 
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Select Transmission</option>
                            <option value="manual">Manual</option>
                            <option value="automatic">Automatic</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Capacity (Seats)</label>
                        <input type="number" name="capacity" min="1" placeholder="4"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Price (per day)</label>
                        <input type="number" name="price" step="0.01" min="0" placeholder="500000"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Status</label>
                        <select name="car_status" 
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            <option value="available">Available</option>
                            <option value="booked">Booked</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                </div>

                <!-- STEP 3: Rental Type & Features -->
                <div x-show="step === 3" class="space-y-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Rental Type</label>
                        <div class="flex items-center space-x-6">
                            <label class="inline-flex items-center">
                                <input type="radio" name="rental_type" value="0" class="form-radio" checked>
                                <span class="ml-2">Standard (Self Drive)</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="rental_type" value="1" class="form-radio">
                                <span class="ml-2">With Driver</span>
                            </label>
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium">What's Included</label>
                            <textarea name="include" rows="4" placeholder="Air conditioning, GPS, Insurance, etc..."
                                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium">Additional Features</label>
                            <textarea name="additional" rows="4" placeholder="Child seat, Roof rack, Extra driver, etc..."
                                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                    </div>
                </div>

                <!-- STEP 4: Notes -->
                <div x-show="step === 4" class="space-y-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Note (Optional)</label>
                        <input id="note-add" type="hidden" name="notes">
                        <trix-editor input="note-add" class="border border-gray-300 rounded-lg bg-white"
                                     style="max-height: 200px;"></trix-editor>
                        <p class="text-xs text-gray-400 mt-1">Use this to provide extra information for customers.</p>
                    </div>
                </div>

                <!-- STEP 5: Images -->
                <div x-show="step === 5" class="space-y-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Main Image (Required)</label>
                        <input type="file" name="image_car_1" accept="image/*" required
                               data-preview="preview-image-1"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-400 mt-1">Upload main image (jpg, png, max 2MB)</p>

                        <div class="mt-4 flex justify-center">
                            <div class="w-48 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center">
                                <img id="preview-image-1" src="" alt="Preview"
                                     class="w-full h-full object-cover rounded-lg hidden">
                                <span id="placeholder-preview-1" class="text-gray-400 text-sm">Main Image Preview</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium">Image 2 (Optional)</label>
                            <input type="file" name="image_car_2" accept="image/*"
                                   data-preview="preview-image-2"
                                   class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

                            <div class="mt-4 flex justify-center">
                                <div class="w-32 h-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center">
                                    <img id="preview-image-2" src="" alt="Preview"
                                         class="w-full h-full object-cover rounded-lg hidden">
                                    <span id="placeholder-preview-2" class="text-gray-400 text-sm">Image 2 Preview</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium">Image 3 (Optional)</label>
                            <input type="file" name="image_car_3" accept="image/*"
                                   data-preview="preview-image-3"
                                   class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

                            <div class="mt-4 flex justify-center">
                                <div class="w-32 h-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center">
                                    <img id="preview-image-3" src="" alt="Preview"
                                         class="w-full h-full object-cover rounded-lg hidden">
                                    <span id="placeholder-preview-3" class="text-gray-400 text-sm">Image 3 Preview</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation buttons -->
                <div class="flex justify-between pt-8 border-t mt-8 border-gray-100">
                    <button type="button" @click="step = Math.max(step - 1, 1)" x-show="step > 1"
                            class="px-6 py-3 text-sm font-medium bg-gray-200 rounded-lg hover:bg-gray-300">Previous</button>

                    <div class="ml-auto">
                        <button type="button" @click="step = step + 1" x-show="step < 5"
                                class="px-6 py-3 text-sm font-medium bg-blue-600 text-white rounded-lg hover:bg-blue-700">Next</button>

                        <button type="submit" x-show="step === 5"
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
document.addEventListener('DOMContentLoaded', function() {
    // Image Preview
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                const previewId = this.getAttribute('data-preview');
                const preview = document.getElementById(previewId);
                const placeholderId = 'placeholder-' + previewId;
                const placeholder = document.getElementById(placeholderId);

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    });
});
</script>