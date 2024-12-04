@props(['icon', 'label', 'value'])

<div class="bg-emerald-900/50 p-3 sm:p-4 rounded-lg hover:bg-emerald-900/70 transition-colors">
    <div class="flex items-start sm:items-center gap-2 sm:gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-emerald-400 flex-shrink-0 mt-1 sm:mt-0"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            {!! $icon !!}
        </svg>
        <div class="flex-1 min-w-0">
            <p class="text-xs sm:text-sm text-emerald-300 font-medium">{{ $label }}</p>
            <p class="font-semibold text-sm sm:text-base truncate">{{ $value }}</p>
        </div>
    </div>
</div>
