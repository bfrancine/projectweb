@if ($message || session($type))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <span class="block sm:inline font-semibold">
            {{ $message ?: session($type) }}
        </span>
    </div>
@endif
