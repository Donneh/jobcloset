@props(['title'])
<header {{ $attributes }}>
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
            {{ $title }}
        </h1>

        <div>
            <livewire:cart-button/>
        </div>
    </div>

    <hr class="my-4"/>
</header>
