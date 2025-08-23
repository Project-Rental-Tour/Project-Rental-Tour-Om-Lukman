<div class="relative w-full max-w-3xl px-4 slide-down">
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Edit Destination Item</h3>
                <p class="text-sm text-gray-500 mt-1">Edit the destination details</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="edit-modal-{{ $destination->destination_id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6">
            <form class="grid gap-6 md:grid-cols-5" id="edit-form-{{ $destination->destination_id }}"
                enctype="multipart/form-data"
                action="{{ route('manage-destination.update', $destination->destination_id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $destination->destination_id }}">

                <div class="space-y-4 md:col-span-3">
                    <div>
                        <label for="edit-name_package-{{ $destination->destination_id }}"
                            class="block mb-1 text-sm font-medium text-gray-700">
                            Name Package <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit-name_package-{{ $destination->destination_id }}" required
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Name Package" name="name_package" value="{{ $destination->name_package }}">
                        <p class="mt-1 text-sm text-red-600 hidden"
                            id="edit-name_package-error-{{ $destination->destination_id }}">
                        </p>
                    </div>

                    <div>
                        <label for="edit-place-{{ $destination->destination_id }}"
                            class="block mb-1 text-sm font-medium text-gray-700">
                            Place <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit-place-{{ $destination->destination_id }}" required
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Place" name="place" value="{{ $destination->place }}">
                        <p class="mt-1 text-sm text-red-600 hidden"
                            id="edit-place-error-{{ $destination->destination_id }}">
                        </p>
                    </div>

                    <div>
                        <label for="edit-price-{{ $destination->destination_id }}"
                            class="block mb-1 text-sm font-medium text-gray-700">
                            Price <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit-price-{{ $destination->destination_id }}"
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 price-input"
                            placeholder="Rp 1.000.000" name="price"
                            value="{{ number_format((float) $destination->price, 0, ',', '.') }}">
                        <p class="mt-1 text-sm text-red-600 hidden"
                            id="edit-price-error-{{ $destination->destination_id }}">
                        </p>
                    </div>

                    <div>
                        <label for="edit-time-{{ $destination->destination_id }}"
                            class="block mb-1 text-sm font-medium text-gray-700">
                            Time <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit-time-{{ $destination->destination_id }}" required
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="How Long" name="time" value="{{ $destination->time }}">
                        <p class="mt-1 text-sm text-red-600 hidden"
                            id="edit-time-error-{{ $destination->destination_id }}">
                        </p>
                    </div>

                    <div>
                        <label for="edit-facility-{{ $destination->destination_id }}"
                            class="block mb-1 text-sm font-medium text-gray-700">
                            Facility <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit-facility-{{ $destination->destination_id }}" required
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="facility" name="facility" value="{{ $destination->facility }}">
                        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Gunakan
                            koma untuk memisahkan fasilitas.
                        </p>
                        <p class="mt-1 text-sm text-red-600 hidden"
                            id="edit-facility-error-{{ $destination->destination_id }}">
                        </p>
                    </div>

                    <div>
                        <label for="edit-destination_photo-{{ $destination->destination_id }}"
                            class="block mb-1 text-sm font-medium text-gray-700">
                            Image (Leave empty to keep current)
                        </label>
                        <input type="file" id="edit-destination_photo-{{ $destination->destination_id }}"
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            name="destination_photo" accept="image/jpeg,image/png,image/jpg,image/gif">
                        <p class="mt-1 text-sm text-gray-500">
                            Current:
                            <a href="{{ asset($destination->destination_photo) }}" target="_blank"
                                class="text-blue-600 hover:underline current-image-link"
                                id="current-image-link-{{ $destination->destination_id }}">
                                View Image
                            </a>
                        </p>
                        <p class="mt-1 text-sm text-red-600 hidden"
                            id="edit-destination_photo-error-{{ $destination->destination_id }}">
                        </p>
                    </div>
                </div>

                <div class="md:col-span-2 flex flex-col items-center justify-center">
                    <div
                        class="w-40 h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-4">
                        <img id="edit-preview-{{ $destination->destination_id }}"
                            src="{{ asset($destination->destination_photo) }}" alt="Preview"
                            class="w-full h-full object-cover rounded-lg">
                    </div>
                </div>

                <div class="flex justify-end pt-4 space-x-3 border-t border-gray-100 md:col-span-5">
                    <button type="button"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 "
                        data-modal-toggle="edit-modal-{{ $destination->destination_id }}">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex items-center px-5 py-2.5 text-sm font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 ">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Destination
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>