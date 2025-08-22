<div
    class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
    <div class="py-5 text-left px-6">
        <!-- Header -->
        <div class="flex justify-between items-center pb-4 border-b border-slate-200">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Tour Details</h2>
                <p class="text-slate-500 text-sm mt-1">Complete tour information</p>
            </div>
            <button onclick="closeModal('viewTourModal')"
                class="cursor-pointer rounded-full p-2 hover:bg-slate-100 transition-colors">
                <i class="fas fa-times text-slate-500 text-lg"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="py-5">
            <h3 class="text-xl font-semibold text-slate-800 mb-2" id="view_tour_title">Bali Adventure Tour</h3>

            <div class="flex items-center mb-5">
                <span
                    class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                    <i class="fas fa-hiking mr-1.5"></i> Adventure
                </span>
                <span class="text-sm text-slate-500 ml-4" id="view_tour_id">ID: TR-001</span>
            </div>

            <div class="mb-5">
                <h4 class="text-slate-700 font-medium mb-2 flex items-center">
                    <i class="fas fa-align-left mr-2 text-slate-400"></i> Description
                </h4>
                <p class="text-slate-600 bg-slate-50 p-4 rounded-lg" id="view_tour_description">Explore the beautiful
                    landscapes of Bali with our adventure tour package. Visit waterfalls, volcanoes, and traditional
                    villages. This tour includes hiking, cultural experiences, and local cuisine tasting.</p>
            </div>

            <div class="mb-5">
                <h4 class="text-slate-700 font-medium mb-2 flex items-center">
                    <i class="fas fa-concierge-bell mr-2 text-slate-400"></i> Facilities
                </h4>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                        <i class="fas fa-bus mr-1.5"></i>Transportation
                    </span>
                    <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                        <i class="fas fa-user mr-1.5"></i>Guide
                    </span>
                    <span class="inline-flex items-center px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm">
                        <i class="fas fa-utensils mr-1.5"></i>Meals
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-600 bg-slate-50 p-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-calendar-plus mr-2 text-slate-400"></i>
                    <p><strong>Created:</strong> <span id="view_tour_created">June 15, 2023</span></p>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar-check mr-2 text-slate-400"></i>
                    <p><strong>Last Updated:</strong> <span id="view_tour_updated">June 20, 2023</span></p>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-200">
            <button onclick="closeModal('viewTourModal')"
                class="flex items-center gap-2 bg-slate-500 hover:bg-slate-600 text-white py-2.5 px-5 rounded-xl font-medium transition-colors">
                <i class="fas fa-times"></i> Close
            </button>
        </div>
    </div>
</div>