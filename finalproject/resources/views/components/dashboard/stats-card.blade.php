@php
    $colorClasses = match ($color ?? 'green') {
        'purple' => 'text-purple-500',
        'blue' => 'text-blue-500',
        'orange' => 'text-orange-500',
        'green' => 'text-green-500',
        default => 'text-green-500',
    };

    $valueColorClasses = match ($valueColor ?? 'gray') {
        'purple' => 'text-purple-600',
        'blue' => 'text-blue-600',
        'orange' => 'text-orange-600',
        'green' => 'text-green-600',
        default => 'text-gray-600',
    };
@endphp

<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-700">{{ $title }}</h3>
        @if (isset($icon))
            <span class="{{ $colorClasses }}">
                <x-dynamic-component :component="$icon" class="w-6 h-6" />
            </span>
        @endif
    </div>
    <p class="text-3xl font-bold {{ $valueColorClasses }}">{{ $value }}</p>
</div>
