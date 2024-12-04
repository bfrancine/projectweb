@extends('layouts.auth')

@section('title', 'Register a Friend')

@section('content')
    <div class="bg-gradient-to-br from-green-50 to-emerald-50 min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div class="w-full max-w-2xl bg-white rounded-lg shadow-sm p-8">
            <!-- Back to Login Button -->
            <div class="mb-6">
                <a href="{{ route('login') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Back to Login
                </a>
            </div>

            <h1 class="text-2xl text-center text-gray-800 mb-8">Register a Friend</h1>

            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Two-column layout for name -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="first_name">
                            First Name
                        </label>
                        <input type="text" id="first_name" name="first_name"
                            class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 ease-in-out"
                            placeholder="Name">
                        @error('first_name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="last_name">
                            Last Name
                        </label>
                        <input type="text" id="last_name" name="last_name"
                            class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 ease-in-out"
                            placeholder="Last Name">
                        @error('last_name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Two-column layout for contact info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Phone Number -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="phone">
                            Phone Number
                        </label>
                        <input type="tel" id="phone" name="phone"
                            class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 ease-in-out"
                            placeholder="Phone">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="email">
                            Email
                        </label>
                        <input type="email" id="email" name="email"
                            class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 ease-in-out"
                            placeholder="Email">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Two-column layout for contact info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="password">
                            Password
                        </label>
                        <input type="password" id="password" name="password"
                            class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 ease-in-out"
                            placeholder="Password">
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="password_confirmation">
                            Confirm Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 ease-in-out"
                            placeholder="Confirm Password">
                        @error('password_confirmation')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Two-column layout for location -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Country -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="country">
                            Country
                        </label>
                        <select id="country" name="country"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent transition-colors text-gray-900">
                            <option value="">Select your country</option>
                            <option value="GT">Guatemala</option>
                            <option value="SV">El Salvador</option>
                            <option value="HN">Honduras</option>
                            <option value="NI">Nicaragua</option>
                            <option value="CR">Costa Rica</option>
                        </select>
                        @error('country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="address">
                            Address
                        </label>
                        <input type="text" id="address" name="address"
                            class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 ease-in-out"
                            placeholder="Address">
                        @error('address')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-emerald-600 text-white py-3 px-4 rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-150 ease-in-out font-medium">
                    REGISTER FRIEND
                </button>
            </form>
        </div>
    </div>
@endsection
