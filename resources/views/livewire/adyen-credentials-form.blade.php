<div>
    <form wire:submit="submit">
        {{ $this->form }}

        <x-primary-button type="submit">
            Submit
        </x-primary-button>
    </form>

    <x-filament-actions::modals />
</div>
