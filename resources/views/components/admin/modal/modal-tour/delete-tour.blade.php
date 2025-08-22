<div
    class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
    <div class="py-5 text-left px-6">
        <!-- Header -->
        <div class="flex justify-between items-center pb-4 border-b border-slate-200">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Delete Tour</h2>
                <p class="text-slate-500 text-sm mt-1">Remove tour permanently</p>
            </div>
            <button onclick="closeModal('deleteTourModal')"
                class="cursor-pointer rounded-full p-2 hover:bg-slate-100 transition-colors">
                <i class="fas fa-times text-slate-500 text-lg"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="py-5">
            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-red-100 mx-auto mb-5">
                <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
            </div>

            <p class="text-slate-600 text-center mb-5">Are you sure you want to delete the following tour?</p>

            <div class="bg-slate-50 p-4 rounded-lg border border-slate-200 mb-5">
                <h3 class="font-bold text-lg text-slate-800 text-center" id="delete_tour_title">Bali Adventure Tour</h3>
                <div class="flex justify-center mt-2">
                    <span
                        class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                        <i class="fas fa-hiking mr-1.5"></i> Adventure
                    </span>
                </div>
            </div>

            <p class="text-red-500 text-sm text-center mb-5 flex items-center justify-center">
                <i class="fas fa-exclamation-circle mr-2"></i>This action cannot be undone.
            </p>
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-200">
            <button onclick="closeModal('deleteTourModal')"
                class="px-5 py-2.5 mr-3 text-slate-700 bg-slate-200 rounded-xl hover:bg-slate-300 transition-colors">Cancel</button>
            <button onclick="confirmDelete()"
                class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white py-2.5 px-5 rounded-xl font-medium transition-colors">
                <i class="fas fa-trash"></i> Delete Tour
            </button>
        </div>
    </div>
</div>