@extends('layouts.auth')

@section('title', 'Unauthorized')

@section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="max-w-md text-center">
            <h2 class="text-2xl font-bold text-red-600 mb-4">Unauthorized Access</h2>
            <p class="text-gray-600 mb-6">Sorry, you do not have permission to access this page.</p>
            <a href="{{ url('/') }}" class="inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Return to Home
            </a>
        </div>
    </div>
