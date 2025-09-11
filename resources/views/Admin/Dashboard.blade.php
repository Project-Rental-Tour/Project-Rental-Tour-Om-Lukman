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
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Users Card -->
            <div class="stat-card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-2">Total Users</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ number_format($totalUsers) }}</h3>
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
                    <h3 class="text-3xl font-bold text-gray-800">{{ $totalDestinations }}</h3>
                    <p class="text-xs text-blue-500 mt-2"><i class="fas fa-plus mr-1"></i> {{ $totalDestinations - 22 }} new
                        this month</p>
                </div>
                <div class="icon-container w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-green-600 text-xl"></i>
                </div>
            </div>

            <!-- Total Booking Card -->
            <div class="stat-card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-2">Total Booking</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $totalBookings }}</h3>
                    <p class="text-xs text-green-500 mt-2"><i class="fas fa-arrow-up mr-1"></i> 8% from last month</p>
                </div>
                <div class="icon-container w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-check text-yellow-600 text-xl"></i>
                </div>
            </div>

            

            <!-- Total Gallery Card -->
            <div class="stat-card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-2">Total Gallery</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $totalGalleries }}</h3>
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
                    <h3 class="text-3xl font-bold text-gray-800">{{ $totalTestimonials }}</h3>
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
            <div class="dashboard-card bg-white shadow rounded-lg p-6 lg:col-span-3">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">Booking Terbaru</h2>
                    <a href="{{ route('manage-booking.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat
                        Semua</a>
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
                            @forelse($recentBookings as $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $booking->first_name }} {{ $booking->last_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ Str::limit($booking->destination_name ?? 'Custom Trip', 20) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($booking->travel_date)->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ ucfirst($booking->package_type) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No bookings yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Latest Blogs -->
            
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
                            @forelse($recentActivities as $activity)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ Str::limit($activity->username, 15) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ Str::limit($activity->action, 50) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">No activity yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Website Profile Section -->
            <div class="dashboard-card bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Website Profile</h2>
                <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6 bg-white p-6 rounded-xl shadow-md">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Website Name</label>
                        <input type="text" name="website_name"
                            value="{{ old('website_name', $profile->website_name ?? '') }}"
                            placeholder="Enter your website name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Website Logo (Light)</label>
                        <input 
                            id="featured_image" 
                            type="file" 
                            name="website_logo_light" 
                            accept="image/*"
                            data-preview="previewPhoto"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none"
                        >
                        @if(!empty($profile->website_logo_light))
                            <div
                                class="w-full mt-2 h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-4">
                                <img src="{{ asset('storage/' . $profile->website_logo_light) }}"
                                    id="previewPhoto"
                                    class="h-full mt-2 rounded-md"
                                    data-original-src="{{ asset('storage/' . $profile->website_logo_light) }}"
                                >
                            </div>
                        @else
                            <div
                                class="w-full mt-2 h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-4">
                                <img 
                                    id="previewPhoto" 
                                    src="" 
                                    alt="Preview" 
                                    class="h-full mt-2 rounded-md hidden"
                                >
                            </div>
                            <span id="placeholder-preview-logo-light" class="text-gray-400 text-sm">No image</span>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Website Logo (Dark)</label>
                        <input 
                            id="featured_image" 
                            type="file" 
                            name="website_logo_dark" 
                            accept="image/*"
                            data-preview="previewPhoto"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none"
                        >
                        @if(!empty($profile->website_logo_dark))
                            <div
                                class="w-full mt-2 h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-4">
                                <img src="{{ asset('storage/' . $profile->website_logo_dark) }}"
                                    id="previewPhoto"
                                    class="h-full mt-2 rounded-md bg-gray-800 p-2"
                                    data-original-src="{{ asset('storage/' . $profile->website_logo_dark) }}"
                                >
                            </div>
                        @else
                            <div
                                class="w-full mt-2 h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-4">
                                <img 
                                    id="previewPhoto" 
                                    src="" 
                                    alt="Preview" 
                                    class="h-full mt-2 rounded-md bg-gray-800 p-2 hidden"
                                >
                            </div>
                            <span id="placeholder-preview-logo-dark" class="text-gray-400 text-sm">No image</span>
                        @endif
                    </div>


                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumbotron Heading</label>
                        <input type="text" name="jumbotron_heading"
                            value="{{ old('jumbotron_heading', $profile->jumbotron_heading ?? '') }}"
                            placeholder="Catchy main heading for your homepage"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumbotron Sub Heading</label>
                        <textarea name="jumbotron_subheading" rows="3" placeholder="Add a short description or tagline"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('jumbotron_subheading', $profile->jumbotron_subheading ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image Jumbotron</label>
                        <input 
                            id="featured_image" 
                            type="file" 
                            name="jumbotron_image" 
                            accept="image/*"
                            data-preview="previewPhoto"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none"
                        >
                        @if(!empty($profile->jumbotron_image))
                            <div
                                class="w-full mt-2 h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-4">
                                <img src="{{ asset('storage/' . $profile->jumbotron_image) }}"
                                    id="previewPhoton"
                                    class="h-20 mt-2 rounded-md"
                                    data-original-src="{{ asset('storage/' . $profile->jumbotron_image) }}"
                                >
                            </div>
                        @else
                            <div
                                class="w-full mt-2 h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center mb-4">
                                <img 
                                    id="previewPhoto" 
                                    src="" 
                                    alt="Preview" 
                                    class="h-20 mt-2 rounded-md hidden"
                                >
                            </div>
                            <span id="placeholder-preview-jumbotron" class="text-gray-400 text-sm">No image</span>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">About Heading</label>
                        <input type="text" name="about_heading"
                            value="{{ old('about_heading', $profile->about_heading ?? '') }}"
                            placeholder="Section title for About Us"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">About Description</label>
                        <textarea name="about_description" rows="3"
                            placeholder="Write a short description about your company or website"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('about_description', $profile->about_description ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <textarea name="address" rows="3" placeholder="Enter full address"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('address', $profile->address ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Email</label>
                        <input type="email" name="contact_email"
                            value="{{ old('contact_email', $profile->contact_email ?? '') }}"
                            placeholder="example@email.com"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" name="phone_number"
                            value="{{ old('phone_number', $profile->phone_number ?? '') }}" placeholder="+62 812 3456 7890"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Social Media Links</label>
                        <div class="flex items-center flex-1">
                            <span class="bg-black p-2 rounded-l-md">
                                <i class="fab fa-tiktok text-white"></i>
                            </span>
                            <input type="text" name="facebook_link"
                                value="{{ old('facebook_link', $profile->facebook_link ?? '') }}"
                                placeholder="Tiktok Page URL"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-r-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Facebook -->


                        <!-- Instagram -->
                        <div class="flex items-center flex-1 mt-4">
                            <span class="bg-pink-100 p-2 rounded-l-md">
                                <i class="fab fa-instagram text-pink-600"></i>
                            </span>
                            <input type="text" name="instagram_link"
                                value="{{ old('instagram_link', $profile->instagram_link ?? '') }}"
                                placeholder="Instagram Profile URL"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-r-md focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                        </div>

                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Operating Hours</label>
                        <input type="text" name="operating_hours"
                            value="{{ old('operating_hours', $profile->operating_hours ?? '') }}"
                            placeholder="Mon - Fri, 08:00 - 17:00"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 px-4 rounded-md font-medium shadow hover:bg-blue-700 transition">
                        Update Profile
                    </button>
                </form>


            </div>
        </div>
    </div>
@endsection