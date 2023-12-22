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
            <x-filament::dropdown.list.item>
                <a href="/user-profile" wire:navigate="">
                    Profile
                </a>
            </x-filament::dropdown.list.item>
            <x-filament::dropdown.list.item x-show="$wire.isTenantOwner">
                <a href="/company-settings" wire:navigate="">
                    Company settings
                </a>
            </x-filament::dropdown.list.item>
            <x-filament::dropdown.list.item wire:click="signOut">
                Sign out
            </x-filament::dropdown.list.item>
        </x-filament::dropdown.list>
    </x-filament::dropdown>
</div>
