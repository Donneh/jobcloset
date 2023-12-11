<div>
    <x-filament::dropdown as="div" class="relative inline-block text-left w-full">
        <x-slot name="trigger" >
            <button
                class="inline-flex w-full justify-center gap-x-1.5 rounded-md text-white outline-none
                px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-none
                hover:bg-slate-800" id="menu-button" aria-expanded="true" aria-haspopup="true">
                {{ auth()->user()->name }}
                <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </button>
        </x-slot>

        <x-filament::dropdown.list>
            <x-filament::dropdown.list.item wire:click="openViewModal">
                Profile
            </x-filament::dropdown.list.item>
            <x-filament::dropdown.list.item wire:click="signOut">
                Sign out
            </x-filament::dropdown.list.item>
        </x-filament::dropdown.list>
{{--        <div>--}}
{{--            <button class="inline-flex w-full justify-center gap-x-1.5 rounded-md py-2 text-sm font-semibold text-neutral-50 hover:bg-gray-800">--}}
{{--                {{ auth()->user()->name }}--}}
{{--                <x-icon name="chevron-down" class="-mr-1 h-5 w-5 text-gray-400"--}}
{{--                        aria-hidden="true">--}}

{{--                />--}}
{{--            </button>--}}
{{--        </div>--}}

{{--        <Transition--}}
{{--            as={Fragment}--}}
{{--            enter="transition ease-out duration-100"--}}
{{--            enterFrom="transform opacity-0 scale-95"--}}
{{--            enterTo="transform opacity-100 scale-100"--}}
{{--            leave="transition ease-in duration-75"--}}
{{--            leaveFrom="transform opacity-100 scale-100"--}}
{{--            leaveTo="transform opacity-0 scale-95"--}}
{{--        >--}}
{{--            <Menu.Items class="absolute left-0 bottom-10 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">--}}
{{--                <div class="px-4 py-3">--}}
{{--                    <p class="text-sm text-gray-400">Signed in as</p>--}}
{{--                    <p class="truncate text-sm font-medium text-gray-900">--}}
{{--                        {auth.user.data.name}--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <div class="py-1">--}}
{{--                    <Menu.Item>--}}
{{--                        {({ active }) => (--}}
{{--                        <a--}}
{{--                            href={route("profile.edit")}--}}
{{--                            class={classs(--}}
{{--                            active--}}
{{--                            ? "bg-gray-100 text-gray-900"--}}
{{--                        : "text-gray-700",--}}
{{--                        "block px-4 py-2 text-sm"--}}
{{--                        )}--}}
{{--                        >--}}
{{--                        User settings--}}
{{--                        </a>--}}
{{--                        )}--}}
{{--                    </Menu.Item>--}}
{{--                    {auth.user.can.includes("view company settings") && (--}}
{{--                    <Menu.Item>--}}
{{--                        {({ active }) => (--}}
{{--                        <a--}}
{{--                            href={route("company-settings.index")}--}}
{{--                            class={classs(--}}
{{--                            active--}}
{{--                            ? "bg-gray-100 text-gray-900"--}}
{{--                        : "text-gray-700",--}}
{{--                        "block px-4 py-2 text-sm"--}}
{{--                        )}--}}
{{--                        >--}}
{{--                        Company settings--}}
{{--                        </a>--}}
{{--                        )}--}}
{{--                    </Menu.Item>--}}
{{--                    )}--}}
{{--                </div>--}}
{{--                <div class="py-1">--}}
{{--                    <form method="POST" onSubmit={signOut}>--}}
{{--                        <Menu.Item>--}}
{{--                            {({ active }) => (--}}
{{--                            <button--}}
{{--                                type="submit"--}}
{{--                                class={classs(--}}
{{--                                active--}}
{{--                                ? "bg-gray-100 text-gray-900"--}}
{{--                            : "text-gray-700",--}}
{{--                            "block w-full px-4 py-2 text-left text-sm"--}}
{{--                            )}--}}
{{--                            >--}}
{{--                            Sign out--}}
{{--                            </button>--}}
{{--                            )}--}}
{{--                        </Menu.Item>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </Menu.Items>--}}
{{--        </Transition>--}}
    </x-filament::dropdown>
</div>
