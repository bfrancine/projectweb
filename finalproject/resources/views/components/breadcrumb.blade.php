@props(['items'])

<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        {{-- Dashboard --}}
        <li class="inline-flex items-center ml-4">
            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-emerald-700 hover:text-emerald-900">
                    @elseif(auth()->user()->role === 'operator')
                        <a href="{{ route('operator.dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-emerald-700 hover:text-emerald-900">
                        @else
                            <a href="{{ route('friend.dashboard') }}"
                                class="inline-flex items-center text-sm font-medium text-emerald-700 hover:text-emerald-900">
                @endif
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                    </path>
                </svg>
                Dashboard
                </a>
            @endauth
        </li>

        {{-- Back Route - if exist --}}
        @if (isset($items[0]))
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    @if (isset($items[0]['previous']) && $items[0]['previous'])
                        <a href="{{ url()->previous() }}"
                            class="ml-1 text-sm font-medium text-emerald-700 hover:text-emerald-900 md:ml-2">
                            {{ $items[0]['label'] }}
                        </a>
                    @elseif (isset($items[0]['route']))
                        <a href="{{ route($items[0]['route']) }}"
                            class="ml-1 text-sm font-medium text-emerald-700 hover:text-emerald-900 md:ml-2">
                            {{ $items[0]['label'] }}
                        </a>
                    @else
                        <span class="ml-1 text-sm font-medium text-emerald-700 md:ml-2">{{ $items[0]['label'] }}</span>
                    @endif
                </div>
            </li>
        @endif

        {{-- Current page --}}
        @if (isset($items[1]))
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-emerald-800 md:ml-2">{{ $items[1]['label'] }}</span>
                </div>
            </li>
        @endif
    </ol>
</nav>
