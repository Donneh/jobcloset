<div class="w-screen p-2 md:hidden fixed top-0 z-10" x-data="{ open: false }">
    <nav
        class="bg-gray-950 rounded-xl flex-col px-4 flex"
        :class="open ? 'h-full' : 'h-16'"
    >
        <div class="flex justify-between w-full items-center h-16">
            <x-application-logo class="w-12 h-12 fill-white"/>

            <div class="" @click="open = !open">
                <x-heroicons::solid.bars-3 class="w-8 h-10 fill-white"/>
                <span class="sr-only">Menu</span>
            </div>
        </div>

        <div
            x-show="open"
            x-collapse
        >
            <nav class="h-full px-4 py-8 mt-8 space-y-2">
                <x-responsive-nav-link
                    href="{{ route('shop.index') }}"
                    :active="Route::is('shop.*')"
                >
                    <x-heroicons::solid.gift class="w-6 h-6 mr-2"/>
                    <span>Shop</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link
                    href="{{ route('users.index') }}"
                    :active="Route::is('users.*')"
                >
                    <x-heroicons::solid.users class="w-6 h-6 mr-2"/>
                    <span>Users</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link
                    href="{{ route('products.index') }}"
                    :active="Route::is('products.*')"
                >
                    <x-heroicons::solid.cube class="w-6 h-6 mr-2"/>
                    <span>Product</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link
                    href="{{ route('departments.index') }}"
                    :active="Route::is('departments.*')"
                >
                    <x-heroicons::solid.user-group class="w-6 h-6 mr-2"/>
                    <span>Departments</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link
                    href="{{ route('job-titles.index') }}"
                    :active="Route::is('job-titles.*')"
                >
                    <x-heroicons::solid.briefcase class="w-6 h-6 mr-2"/>
                    <span>Job titles</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link
                    href="{{ route('locations.index') }}"
                    :active="Route::is('locations.*')"
                >
                    <x-heroicons::solid.globe-alt class="w-6 h-6 mr-2"/>
                    <span>Locations</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link
                    href="{{ route('orders.index') }}"
                    :active="Route::is('orders.*')"
                >
                    <x-heroicons::solid.credit-card class="w-6 h-6 mr-2"/>
                    <span>Orders</span>
                </x-responsive-nav-link>
            </nav>
        </div>
    </nav>
</div>
