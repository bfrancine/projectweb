@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-emerald-50 p-4">
        <div class="w-full max-w-4xl">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    <!-- Left Panel - Brand -->
                    <div class="bg-emerald-900 p-8 text-white md:w-1/2 flex flex-col justify-center items-center">
                        <div class="mb-8">
                            <svg class="h-16 text-emerald-200" version="1.1" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="373.294px" height="373.294px" viewBox="0 0 373.294 373.294"
                                style="enable-background:new 0 0 373.294 373.294;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M334.59,231.841c-21.18,1.306-49.043,22.475-75.924,34.648c-32.926,14.896-84.205,2.914-84.21,2.914
                                   c7.899-3.703,40.039-11.36,46.517-14.221c34.41-15.123,31.508-46.688,15.119-46.422c-21.668,0.364-34.363,5.679-77.568,11.569
                                   c-32.746,4.451-71.474,2.824-90.053,9.916C42.247,240.265,0,307.656,0,307.656l65.311,63.271c0,0,40.424-39.805,60.092-39.805
                                   c44.818,0,46.637-0.615,88.266-2.863c17.683-0.946,21.39-1.673,31.513-5.104c53.945-18.224,111.875-66.802,112.941-72.647
                                   C360.6,236.979,345.799,231.145,334.59,231.841z" />
                                        <path d="M244.463,133.917c1.123,0.229,2.266-0.267,2.873-1.238c15.004-24.178,37.66-53.426,67.203-73.303
                                   c-27.535,26.443-46.979,54.278-58.766,80.481c-0.354,0.787-0.314,1.691,0.102,2.446c0.42,0.754,1.168,1.268,2.023,1.386
                                   c1.924,0.261,3.922,0.396,5.934,0.396c18.869,0,37.664-11.498,50.105-21.142c14.209-11.013,27.854-25.565,36.504-38.935
                                   c12.975-20.053,21.088-44.767,22.846-69.595c0.057-0.79-0.232-1.565-0.793-2.128c-0.562-0.56-1.34-0.854-2.129-0.793
                                   c-18.799,1.331-65.445,7.364-92.723,34.589c-0.953,0.86-10.996,10.101-20.336,24.872c-12.801,20.254-17.99,41.24-14.998,60.697
                                   C242.479,132.784,243.338,133.688,244.463,133.917z" />
                                        <path d="M169.86,162.913c11.859,9.192,29.771,20.148,47.755,20.148c1.918,0,3.822-0.125,5.652-0.379
                                   c0.816-0.112,1.53-0.601,1.928-1.318c0.398-0.718,0.434-1.581,0.1-2.331c-11.232-24.972-29.764-51.5-56.009-76.702
                                   c28.157,18.945,49.751,46.821,64.049,69.862c0.577,0.926,1.671,1.396,2.739,1.178c1.068-0.221,1.891-1.08,2.057-2.159
                                   c2.846-18.541-2.095-38.544-14.297-57.844c-8.9-14.08-18.477-22.882-19.383-23.705C178.457,63.719,134,57.967,116.083,56.7
                                   c-0.751-0.059-1.494,0.22-2.027,0.755c-0.534,0.534-0.811,1.276-0.757,2.029c1.676,23.661,9.407,47.214,21.772,66.323
                                   C143.315,138.55,156.321,152.418,169.86,162.913z" />
                                        <path d="M195.488,73.118c7.9,6.12,19.83,13.419,31.808,13.419c1.276,0,2.546-0.087,3.767-0.254
                                   c0.545-0.074,1.019-0.399,1.283-0.876c0.266-0.482,0.291-1.054,0.065-1.556c-7.481-16.635-19.821-34.301-37.302-51.086
                                   c18.752,12.616,33.134,31.186,42.66,46.53c0.383,0.615,1.113,0.932,1.824,0.785c0.711-0.146,1.258-0.718,1.369-1.438
                                   c1.895-12.35-1.395-25.672-9.521-38.528c-5.928-9.375-12.307-15.24-12.909-15.787C201.216,7.046,171.607,3.216,159.674,2.371
                                   c-0.503-0.039-0.996,0.149-1.353,0.504c-0.355,0.355-0.539,0.85-0.503,1.351c1.115,15.761,6.265,31.448,14.501,44.175
                                   C177.809,56.889,186.473,66.125,195.488,73.118z" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="text-center">
                            <h1 class="text-2xl font-bold mb-2">1 Millón de árboles</h1>
                            <p class="text-emerald-200 text-sm">Join us in making the world greener, one tree at a time.</p>
                        </div>
                    </div>

                    <!-- Right Panel - Login Form -->
                    <div class="p-8 md:w-1/2">
                        <div class="mb-8 text-center">
                            <h2 class="text-2xl font-bold text-gray-800">Welcome Back!</h2>
                            <p class="text-gray-600 mt-2">Sign in to your account to continue</p>
                        </div>

                        <form class="space-y-6" action="{{ route('login') }}" method="POST">
                            @csrf

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                    class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 ease-in-out"
                                    placeholder="Enter your email">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input id="password" name="password" type="password" required
                                    class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 ease-in-out"
                                    placeholder="Enter your password">
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full bg-emerald-600 text-white py-3 px-4 rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-150 ease-in-out font-medium">
                                    Sign in
                                </button>
                            </div>
                        </form>

                        <div class="mt-6">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-200"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">New to our platform?</span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('register') }}"
                                    class="w-full flex justify-center py-3 px-4 rounded-lg border-2 border-emerald-600 text-emerald-600 hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-150 ease-in-out font-medium">
                                    Register as a Friend
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
