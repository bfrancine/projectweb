<div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
    <a href="{{ $route }}" class="block p-6">
        <div class="flex flex-col items-center text-center">
            <div class="bg-{{ $color }}-100 p-4 rounded-full mb-4">
                <span class="text-{{ $color }}-500">
                    <x-dynamic-component :component="$icon" class="w-8 h-8" />
                </span>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $title }}</h3>
            <p class="text-gray-600">{{ $description }}</p>
            <div class="mt-4 inline-flex items-center text-{{ $color }}-500">
                <span>View Details</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </div>
    </a>
</div>
