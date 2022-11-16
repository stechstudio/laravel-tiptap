@props([
    'wide' => false,
    'rightAlign' => true,
])

<div
    x-data="{ open: false }"
    @keydown.escape="open = false" @click.away="open = false"
    {{ $attributes->merge(['class' => 'relative inline-block text-left']) }}
>
    {{ $trigger }}

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute mt-2 rounded-md shadow-lg z-10 {{ $rightAlign ? 'origin-top-right right-0' : 'origin-top-left  left-0' }} {{ $wide ? 'w-56 sm:w-72' : 'w-56' }}"
        style="display: none;"
    >
        <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
            {{ $slot }}
        </div>
    </div>
</div>
