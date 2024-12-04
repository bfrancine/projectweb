<div class="bg-white rounded-lg shadow">
    <div class="p-6 {{ isset($borderBottom) && $borderBottom ? 'border-b' : '' }}">
        <h2 class="text-xl font-semibold {{ isset($titleColor) ? "text-$titleColor" : 'text-gray-800' }}">
            {{ $title }}</h2>
    </div>
    <div class="p-6">
        {{ $slot }}
    </div>
</div>
