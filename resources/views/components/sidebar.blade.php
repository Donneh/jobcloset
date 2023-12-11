<aside class="w-64 h-screen p-2 hidden md:block sticky top-0">
    <div class="bg-gray-950 h-full w-full rounded-xl px-4 py-8 flex flex-col">
        <nav class="mt-8 space-y-2 w-full">

            <x-nav-link
                wire:navigate
                href="{{ route('shop.index') }}"
                :active="Route::is('shop.*')"
            >
                <x-icon name="gift" solid class="w-6 h-6 mr-2"/>
                <span>Shop</span>
            </x-nav-link>

            @can('view products')
                <x-nav-link
                    wire:navigate
                    href="{{ route('products.index') }}"
                    :active="Route::is('products.*')"
                >
                    <x-icon name="cube" solid class="w-6 h-6 mr-2" />
                    <span>Products</span>
                </x-nav-link>
            @endcan

            @can('view users')
                <x-nav-link
                    wire:navigate
                    href="{{ route('users.index') }}"
                    :active="Route::is('users.*')"
                >
                    <x-icon name="users" :solid="true" class="w-6 h-6 mr-2" />
                    <span>Users</span>
                </x-nav-link>
            @endcan

            @can('view departments')
                <x-nav-link
                    wire:navigate
                    href="{{ route('departments.index') }}"
                    :active="Route::is('departments.*')"
                >
                    <x-heroicons::solid.user-group :solid="true" class="w-6 h-6 mr-2" />
                    <span>Departments</span>
                </x-nav-link>
            @endcan

            @can('view job titles')
                <x-nav-link
                    wire:navigate
                    href="{{ route('job-titles.index') }}"
                    :active="Route::is('job-titles.*')"
                >
                    <x-icon name="briefcase" :solid="true" class="w-6 h-6 mr-2" />
                    <span>Job Titles</span>
                </x-nav-link>
            @endcan

            @can('view locations')
                <x-nav-link
                    wire:navigate
                    href="{{ route('locations.index') }}"
                    :active="Route::is('locations.*')"
                >
                    <x-icon name="globe-alt" :solid="true" class="w-6 h-6 mr-2" />
                    <span>Locations</span>
                </x-nav-link>
            @endcan

            @can('view orders')
                <x-nav-link
                    wire:navigate
                    href="{{ route('orders.index') }}"
                    :active="Route::is('orders.*')"
                >
                    <x-icon name="credit-card" :solid="true" class="w-6 h-6 mr-2" />
                    <span>Orders</span>
                </x-nav-link>
            @endcan
        </nav>

        <nav class="text-white mt-auto opacity-100">
            <livewire:user-dropdown />
        </nav>
    </div>
</aside>
