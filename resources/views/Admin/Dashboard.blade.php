@extends('_layouts.app')

@section('pageTitle', 'Dashboard')

@section('head')
@endsection
@section('content')
    <div class="w-full ">
        <div class="bg-white px-4 md:px-6 py-4 md:py-6 rounded-lg shadow-sm mb-6">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
                    <p class="text-sm text-gray-500 mt-1">Ringkasan data sistem & statistik terbaru</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <i class="fas fa-bell text-gray-600"></i>
                        <span
                            class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">3</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-user text-gray-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Users Card -->
            <div class="stat-card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-2">Total Users</p>
                    <h3 class="text-3xl font-bold text-gray-800">1,248</h3>
                    <p class="text-xs text-green-500 mt-2"><i class="fas fa-arrow-up mr-1"></i> 12% from last month</p>
                </div>
                <div class="icon-container w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
            </div>

            <!-- Total Destination Card -->
            <div class="stat-card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-2">Total Destination</p>
                    <h3 class="text-3xl font-bold text-gray-800">24</h3>
                    <p class="text-xs text-blue-500 mt-2"><i class="fas fa-plus mr-1"></i> 2 new this month</p>
                </div>
                <div class="icon-container w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-green-600 text-xl"></i>
                </div>
            </div>

            <!-- Total Booking Card -->
            <div class="stat-card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-2">Total Booking</p>
                    <h3 class="text-3xl font-bold text-gray-800">356</h3>
                    <p class="text-xs text-green-500 mt-2"><i class="fas fa-arrow-up mr-1"></i> 8% from last month</p>
                </div>
                <div class="icon-container w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-check text-yellow-600 text-xl"></i>
                </div>
            </div>

            <!-- Total Blog Card -->
            <div class="stat-card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-2">Total Blog</p>
                    <h3 class="text-3xl font-bold text-gray-800">48</h3>
                    <p class="text-xs text-green-500 mt-2"><i class="fas fa-arrow-up mr-1"></i> 5% from last month</p>
                </div>
                <div class="icon-container w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-blog text-purple-600 text-xl"></i>
                </div>
            </div>

            <!-- Total Gallery Card -->
            <div class="stat-card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-2">Total Gallery</p>
                    <h3 class="text-3xl font-bold text-gray-800">124</h3>
                    <p class="text-xs text-green-500 mt-2"><i class="fas fa-arrow-up mr-1"></i> 15% from last month</p>
                </div>
                <div class="icon-container w-14 h-14 bg-pink-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-images text-pink-600 text-xl"></i>
                </div>
            </div>

            <!-- Total Testimoni Card -->
            <div class="stat-card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-2">Total Testimoni</p>
                    <h3 class="text-3xl font-bold text-gray-800">89</h3>
                    <p class="text-xs text-green-500 mt-2"><i class="fas fa-arrow-up mr-1"></i> 10% from last month</p>
                </div>
                <div class="icon-container w-14 h-14 bg-indigo-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-star text-indigo-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Quick Stats Footer -->
        <div class="mt-8 bg-white rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Performance Summary</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-gray-500">Monthly Growth</p>
                    <p class="text-2xl font-bold text-blue-600">8.5%</p>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <p class="text-sm text-gray-500">Satisfaction Rate</p>
                    <p class="text-2xl font-bold text-green-600">94%</p>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <p class="text-sm text-gray-500">Repeat Customers</p>
                    <p class="text-2xl font-bold text-purple-600">42%</p>
                </div>
            </div>
        </div>

        <!-- Three Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Recent Bookings -->
            <div class="dashboard-card bg-white shadow rounded-lg p-6 lg:col-span-2">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">Booking Terbaru</h2>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Destination</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    John Doe
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Bromo Midnight Tour
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Jun 28, 2023
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Confirmed
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    Jane Smith
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Ijen Blue Fire Tour
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Jun 29, 2023
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    Robert Johnson
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Bali Beach Vacation
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Jun 30, 2023
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Paid
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    Sarah Williams
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Raja Ampat Diving
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Jul 2, 2023
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Confirmed
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Latest Blogs -->
            <div class="dashboard-card bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">Blog Terkini</h2>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua</a>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-md overflow-hidden">
                            <div class="w-full h-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-mountain text-blue-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-900">Exploring Bromo Volcano</h3>
                            <p class="text-xs text-gray-500 mt-1">Jun 25, 2023</p>
                            <div class="flex items-center mt-2">
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Travel</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-md overflow-hidden">
                            <div class="w-full h-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-utensils text-green-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-900">Local Cuisine Guide</h3>
                            <p class="text-xs text-gray-500 mt-1">Jun 22, 2023</p>
                            <div class="flex items-center mt-2">
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Food</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-md overflow-hidden">
                            <div class="w-full h-full bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-camera text-yellow-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-900">Photography Tips for Travelers</h3>
                            <p class="text-xs text-gray-500 mt-1">Jun 18, 2023</p>
                            <div class="flex items-center mt-2">
                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Tips</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Recent Activity Table -->
            <div class="dashboard-card bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    Admin User
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Updated booking #456
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    2 hours ago
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    John Doe
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Created new booking
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    5 hours ago
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    Content Manager
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Published new blog post
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Yesterday
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Website Profile Section -->
            <div class="dashboard-card bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Website Profile</h2>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Website Name</label>
                        <input type="text" placeholder="Website Name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Website Logo</label>
                        <input type="file"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumbotron Heading</label>
                        <input type="text" placeholder="Title of Jumbotron"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumbotron Sub Heading</label>
                        <textarea
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            rows="3" placeholder="Lorem Ipsum ..."></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image Jumbotron</label>
                        <input type="file" value="Travel Indonesia"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">About Heading</label>
                        <input type="text" placeholder="Title of About"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">About Description</label>
                        <textarea
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            rows="3" placeholder="Lorem Ipsum 22..."></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <textarea
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            rows="3" placeholder="Address"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Email</label>
                        <input type="email" placeholder="Email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" placeholder="Phone Number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Social Media Links</label>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex items-center">
                                <span class="bg-blue-100 p-2 rounded-l-md">
                                    <i class="fab fa-facebook text-blue-600"></i>
                                </span>
                                <input type="text" value="travel.indonesia"
                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex items-center">
                                <span class="bg-blue-100 p-2 rounded-l-md">
                                    <i class="fab fa-instagram text-pink-600"></i>
                                </span>
                                <input type="text" value="@travel.indonesia"
                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Operating Hours</label>
                        <input type="text" placeholder="Operating Hours"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Update Profile
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection