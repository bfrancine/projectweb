<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-700">{{ $title }}</h3>
        @if (isset($icon))
            <span class="text-{{ $color ?? 'green' }}-500">
                <x-dynamic-component :component="$icon" class="w-6 h-6" />
            </span>
        @endif
    </div>
    <p class="text-3xl font-bold text-{{ $valueColor ?? 'gray' }}-600">{{ $value }}</p>
</div>
