<div {{ $attributes->class(['w-full']) }}>
    <div class="space-y-6 w-full">
        <div class="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
