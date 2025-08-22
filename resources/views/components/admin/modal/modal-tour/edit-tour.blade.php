<div
    class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
    <div class="py-5 text-left px-6">
        <!-- Header -->
        <div class="flex justify-between items-center pb-4 border-b border-slate-200">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Edit Tour</h2>
                <p class="text-slate-500 text-sm mt-1">Update tour details</p>
            </div>
            <button onclick="closeModal('editTourModal')"
                class="cursor-pointer rounded-full p-2 hover:bg-slate-100 transition-colors">
                <i class="fas fa-times text-slate-500 text-lg"></i>
            </button>
        </div>

        <!-- Body -->
        <form id="editTourForm" class="py-5" action="{{ route('manage-tour.update', $tour->tour_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="edit_title" class="block text-slate-700 text-sm font-medium mb-2">Tour Title <span
                        class="text-red-500">*</span></label>
                <input type="text" id="edit_title" name="title"
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    value="{{ $tour->title }}" required>
            </div>

            <div class="mb-5">
                <label for="edit_description" class="block text-slate-700 text-sm font-medium mb-2">Description <span
                        class="text-red-500">*</span></label>
                <textarea id="edit_description" name="description" rows="4"
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    required>{{ $tour->description }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label for="edit_type" class="block text-slate-700 text-sm font-medium mb-2">Tour Type <span
                            class="text-red-500">*</span></label>
                    <select id="edit_type" name="type"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        required>
                        <option value="Plans" {{ $tour->type == 'Plans' ? 'selected' : '' }}>Plans</option>
                        <option value="Facility" {{ $tour->type == 'Facility' ? 'selected' : '' }}>Facility</option>
                        <option value="Itinerary" {{ $tour->type == 'Itinerary' ? 'selected' : '' }}>Itinerary</option>
                    </select>
                </div>

                <div>
                    <label class="block text-slate-700 text-sm font-medium mb-2">Facilities</label>
                    <input type="text" id="title" name="facility"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        placeholder="Enter facility" value="{{ $tour->facility }}" required>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-200">
                <button type="button" onclick="closeModal('editTourModal')"
                    class="px-5 py-2.5 mr-3 text-slate-700 bg-slate-200 rounded-xl hover:bg-slate-300 transition-colors">Cancel</button>
                <button type="submit"
                    class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white py-2.5 px-5 rounded-xl font-medium transition-colors">
                    <i class="fas fa-sync-alt"></i> Update Tour
                </button>
            </div>
        </form>
    </div>
</div>