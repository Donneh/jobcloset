<div>
    <header>
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                Users
            </h1>

            <div>
                <CartButton />
            </div>

            <hr class="my-4" />
        </div>
    </header>

    <div class="mt-6">
        <a
            href="{{ route("users.create") }}"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
        >
            Create user
        </a>
    </div>

    <div class="mt-6">
        <form wire:submit="create">
            {{ $this->form }}

            <button type="submit"
                    class="inline-flex mt-6 items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                Submit
            </button>
        </form>
    </div>

</div>
