@extends('_layouts.auth')

@section('content')
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-50 to-indigo-50 px-4 py-12 relative overflow-hidden">
        <!-- Overlay gradasi biru muda -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-transparent opacity-80"></div>

        <!-- Card Login -->
        <div class="w-full max-w-md relative z-10">
            <div
                class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all hover:shadow-2xl duration-300">
                <!-- Header Gradient -->
                <div class="bg-gradient-to-b from-blue-600 to-indigo-700 px-8 py-12 text-center text-white">
                    <div class="mb-4">
                        <svg class="w-10 h-10 mx-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold">Welcome Back</h1>
                    <p class="text-blue-100 mt-1 text-sm">Sign in to your account</p>
                </div>

                <!-- Form -->
                <div class="p-8 space-y-6">
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                            <div class="relative">
                                <input type="text" id="username" name="username" required
                                    class="w-full px-4 py-3 pl-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                    placeholder="Enter your username" autofocus>
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password" required
                                    class="w-full px-4 py-3 pl-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                    placeholder="Enter your password">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transform transition-all duration-200 focus:ring-4 focus:ring-blue-300">
                            Login
                        </button>
                    </form>
                </div>

                <!-- Footer -->
                <div class="px-8 py-4 text-center text-xs text-gray-500 border-t border-gray-100">
                    &copy; {{ date('Y') }} goingtothejava.com All rights reserved.
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Auto-focus error -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->has('username') || $errors->has('password'))
                const errorInput = document.querySelector('input:invalid') || document.getElementById('username');
                if (errorInput) {
                    errorInput.focus();
                    errorInput.classList.add('ring-2', 'ring-red-500');
                }
            @endif
                });
    </script>
@endpush