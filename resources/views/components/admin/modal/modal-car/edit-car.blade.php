<div class="relative w-full max-w-4xl px-4 slide-down" x-data="{ step: 1 }">
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Edit Car: {{ $car->name_car }}</h3>
                <p class="text-sm text-gray-500 mt-1">Update car details step by step</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                    data-modal-toggle="edit-car-modal-{{ $car->car_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-8">
            <form id="edit-car-form-{{ $car->car_id }}" enctype="multipart/form-data" 
                  action="{{ route('manage-car.update', $car->car_id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

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
                        <input type="text" name="name_car" value="{{ $car->name_car }}"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Car Type</label>
                        <input type="text" name="car_type" value="{{ $car->car_type }}"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium">Description</label>
                        <textarea name="description" rows="3" 
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>{{ $car->description }}</textarea>
                    </div>
                </div>

                <!-- STEP 2: Specifications -->
                <div x-show="step === 2" class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Transmission</label>
                        <select name="transmission" 
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                            <option value="manual" {{ $car->transmission == 'manual' ? 'selected' : '' }}>Manual</option>
                            <option value="automatic" {{ $car->transmission == 'automatic' ? 'selected' : '' }}>Automatic</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Capacity (Seats)</label>
                        <input type="number" name="capacity" min="1" value="{{ $car->capacity }}"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Price (per day)</label>
                        <input type="number" name="price" step="0.01" min="0" value="{{ $car->price }}"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Status</label>
                        <select name="car_status" 
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            <option value="available" {{ $car->car_status == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="booked" {{ $car->car_status == 'booked' ? 'selected' : '' }}>Booked</option>
                            <option value="maintenance" {{ $car->car_status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>
                </div>

                <!-- STEP 3: Rental Type & Features -->
                <div x-show="step === 3" class="space-y-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Rental Type</label>
                        <div class="flex items-center space-x-6">
                            <label class="inline-flex items-center">
                                <input type="radio" name="rental_type" value="0" class="form-radio" {{ $car->rental_type == false ? 'checked' : '' }}>
                                <span class="ml-2">Standard (Self Drive)</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="rental_type" value="1" class="form-radio" {{ $car->rental_type == true ? 'checked' : '' }}>
                                <span class="ml-2">With Driver</span>
                            </label>
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium">What's Included</label>
                            <textarea name="include" rows="4" 
                                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ $car->include ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium">Additional Features</label>
                            <textarea name="additional" rows="4" 
                                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ $car->additional ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- STEP 4: Notes -->
                <div x-show="step === 4" class="space-y-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Note (Optional)</label>
                        <input 
                            id="note-edit-{{ $car->car_id }}" 
                            type="hidden" 
                            name="notes" 
                            value="{{ $car->notes }}"
                        >
                        <trix-editor 
                            input="note-edit-{{ $car->car_id }}" 
                            class="border border-gray-300 rounded-lg bg-white"
                            style="max-height: 200px; overflow-y: auto;"
                        ></trix-editor>
                        <p class="text-xs text-gray-400 mt-1">Use this to provide extra information for customers.</p>
                    </div>
                </div>

                <!-- STEP 5: Images -->
                <div x-show="step === 5" class="space-y-8 max-w-4xl mx-auto px-2">
                    <!-- Main Image -->
                    <div class="flex flex-col md:flex-row items-start gap-6 p-4 bg-white rounded-xl border border-gray-200 shadow-sm">
                        <!-- Preview (Kiri) -->
                        <div class="flex-shrink-0">
                        <div class="w-48 h-32 border rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center relative">
                            @if($car->image_car_1)
                            <img
                                id="preview-image-1-edit"
                                src="{{ asset($car->image_car_1) }}"
                                alt="Current main image"
                                class="w-full h-full object-cover"
                            />
                            @else
                            <div id="placeholder-preview-1-edit" class="text-center text-gray-400 px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs">No image</span>
                            </div>
                            @endif
                        </div>
                        </div>

                        <!-- Form (Kanan) -->
                        <div class="flex-1 w-full md:max-w-md space-y-2">
                        <label class="block text-sm font-medium text-gray-800">Update Main Image (Optional)</label>
                        <input
                            type="file"
                            name="image_car_1"
                            accept="image/*"
                            data-preview="preview-image-1-edit"
                            data-placeholder="placeholder-preview-1-edit"
                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                        />

                        @if($car->image_car_1)
                            <p class="text-xs text-gray-500 mt-1">
                            Current: <a href="{{ asset($car->image_car_1) }}" target="_blank" class="text-blue-600 hover:underline font-medium">View Image</a>
                            </p>
                        @endif
                        <p class="text-xs text-gray-400">JPG, PNG • Max 2MB</p>
                        </div>
                    </div>

                    <!-- Optional Images -->
                    <div class="grid gap-6 md:grid-cols-2">
                        <!-- Image 2 -->
                        <div class="flex flex-col md:flex-row items-start gap-4 p-4 bg-white rounded-xl border border-gray-200 shadow-sm">
                        <div class="flex-shrink-0">
                            <div class="w-40 h-28 border rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center relative">
                            @if($car->image_car_2)
                                <img
                                id="preview-image-2-edit"
                                src="{{ asset($car->image_car_2) }}"
                                alt="Current image 2"
                                class="w-full h-full object-cover"
                                />
                            @else
                                <div id="placeholder-preview-2-edit" class="text-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs">No image</span>
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="flex-1 w-full md:max-w-xs space-y-2">
                            <label class="block text-sm font-medium text-gray-800">Update Image 2 (Optional)</label>
                            <input
                            type="file"
                            name="image_car_2"
                            accept="image/*"
                            data-preview="preview-image-2-edit"
                            data-placeholder="placeholder-preview-2-edit"
                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                            />
                            @if($car->image_car_2)
                            <p class="text-xs text-gray-500 mt-1">
                                Current: <a href="{{ asset($car->image_car_2) }}" target="_blank" class="text-blue-600 hover:underline font-medium">View Image</a>
                            </p>
                            @endif
                        </div>
                        </div>

                        <!-- Image 3 -->
                        <div class="flex flex-col md:flex-row items-start gap-4 p-4 bg-white rounded-xl border border-gray-200 shadow-sm">
                        <div class="flex-shrink-0">
                            <div class="w-40 h-28 border rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center relative">
                            @if($car->image_car_3)
                                <img
                                id="preview-image-3-edit"
                                src="{{ asset($car->image_car_3) }}"
                                alt="Current image 3"
                                class="w-full h-full object-cover"
                                />
                            @else
                                <div id="placeholder-preview-3-edit" class="text-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs">No image</span>
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="flex-1 w-full md:max-w-xs space-y-2">
                            <label class="block text-sm font-medium text-gray-800">Update Image 3 (Optional)</label>
                            <input
                            type="file"
                            name="image_car_3"
                            accept="image/*"
                            data-preview="preview-image-3-edit"
                            data-placeholder="placeholder-preview-3-edit"
                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                            />
                            @if($car->image_car_3)
                            <p class="text-xs text-gray-500 mt-1">
                                Current: <a href="{{ asset($car->image_car_3) }}" target="_blank" class="text-blue-600 hover:underline font-medium">View Image</a>
                            </p>
                            @endif
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
                            Update Car
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image Preview for Edit Modal
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                const previewId = this.getAttribute('data-preview');
                const preview = document.getElementById(previewId);

                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    });
});
</script>