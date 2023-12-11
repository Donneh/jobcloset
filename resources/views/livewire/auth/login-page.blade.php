<x-layouts.guest>
    <form wire:submit.prevent="submit">
        <div>
            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                wire:model="email"
                class="mt-1 block w-full"
            >

            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                wire:model="password"
                class="mt-1 block w-full"
            >
        </div>

        <div class="flex items-center justify-end mt-4">
            <button
                type="submit"
                class="ml-4"
            >
                Log in
            </button>
        </div>
    </form>
</x-layouts.guest>
