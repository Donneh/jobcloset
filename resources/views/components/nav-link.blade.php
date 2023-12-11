@props([
    'active' => false,
    'className' => ''
])

<a {{ $attributes(['class' => "inline-flex w-full items-center px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none " .
    ($active ? "bg-neutral-50 text-black rounded" : "border-transparent text-gray-500 hover:underline") . $className]) }}>
    {{ $slot }}
</a>
