<div class="relative w-full max-w-3xl px-4 slide-down">
    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Add Destination</h3>
                <p class="text-sm text-gray-500 mt-1">Fill the form below to add a new destination</p>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-500 transition-colors"
                data-modal-toggle="add-modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6">
            <form class="grid gap-6 md:grid-cols-5" id="add-form" enctype="multipart/form-data"
                action="{{route('manage-destination.store')}}" method="POST">
                @csrf

                <div class="space-y-4 md:col-span-3">
                    <div>
                        <label for="name_package" class="block mb-1 text-sm font-medium text-gray-700">
                            Name Package <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name_package" required
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Name Package" name="name_package">
                        <p class="mt-1 text-sm text-red-600 hidden" id="name_package-error"></p>
                    </div>

                    <div>
                        <label for="place" class="block mb-1 text-sm font-medium text-gray-700">
                            Place <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="place" required
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Place" name="place">
                        <p class="mt-1 text-sm text-red-600 hidden" id="place-error"></p>
                    </div>

                    <div>
                        <label for="price" class="block mb-1 text-sm font-medium text-gray-700">
                            Price <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="price" required
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Rp 1.000.000" name="price">
                        <p class="mt-1 text-sm text-red-600 hidden" id="price-error"></p>
                    </div>

                    <div>
                        <label for="destination_photo" class="block mb-1 text-sm font-medium text-gray-700">
                            Image Destination<span class="text-red-500">*</span>
                        </label>
                        <input type="file" id="destination_photo" required
                            class="w-full px-4 py-2.5 text-sm transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            name="destination_photo" accept="image/jpeg,image/png,image/jpg,image/gif">
                        <p class="mt-1 text-sm text-gray-500">JPEG, PNG, JPG, GIF (Max 2MB)</p>
                        <p class="mt-1 text-sm text-red-600 hidden" id="destination_photo-error"></p>
                    </div>
                </div>

                <div class="md:col-span-2 flex flex-col items-center justify-center">
                    <div
                        class="w-40 h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-4">
                        <img id="previewPhoto" src="" alt="Preview"
                            class="w-full h-full object-cover rounded-lg hidden">
                        <span id="placeholderText" class="text-gray-400 text-sm">Image Preview</span>
                    </div>
                </div>

                <div class="flex justify-end pt-4 space-x-3 border-t border-gray-100 md:col-span-5">
                    <button type="button"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        data-modal-toggle="add-modal">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex items-center px-5 py-2.5 text-sm font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Destination
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>