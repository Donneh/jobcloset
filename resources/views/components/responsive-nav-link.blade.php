@props(['active'])

@php
    // Common classes
    $classes = 'w-full flex pl-3 pr-4 py-2 text-base font-medium focus:outline-none transition duration-150 ease-in-out hover:opacity-80';

    // Add extra classes based on active state
    $classes .= $active
                ? ' text-black rounded bg-neutral-50'
                : ' border-transparent text-neutral-50';
@endphp

<a {{ $attributes->class([$classes]) }} wire:navigate>
    {{ $slot }}
</a>
