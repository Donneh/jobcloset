<x-layouts.guest>
    <form wire:submit.prevent="create">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit">
                Create account
            </x-filament::button>
        </div>
    </form>
</x-layouts.guest>
