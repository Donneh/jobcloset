<div key={item.product.id} class="flex py-6 sm:py-10">
    <div class="flex-shrink-0 rounded-lg bg-gray-200">
        <img
            src="storage/{{ $item['product']->image_path }}"
            class="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48"
            alt="{{ $item['product']->name }}"
        />
    </div>

    <div class="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
        <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
            <div>
                <div class="flex justify-between">
                    <h3 class="text-sm">{{ $item['product']->name }}</h3>
                </div>
                <p class="mt-1 text-sm font-medium text-gray-900">
                    € {{ $item['product']->price }}
                </p>
            </div>

            <div class="mt-4 sm:mt-0 sm:pr-9">
                <label
                    htmlFor={`quantity-${item.id}`}
                    class="sr-only"
                >
                    Quantity,
                    {{ $item['product']->name }}
                </label>
                <div class="flex items-center border-gray-100">
                    <form wire:submit.prevent="removeFromCart">
                        <button
                            type="submit"
                            class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50"
                        >
                            <x-icon name="minus-circle"/>
                        </button>
                    </form>
                    <input
                        class="h-8 w-8 border bg-gray-100 text-center text-xs outline-none border-1 border-gray-200"
                        type="text"
                        disabled
                        value="{{ $item['quantity'] }}"
                        min="1"
                    />
                    <form wire:submit.prevent="addOneToCart">
                    <button
                        type="submit"
                        class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50"
                    >
                        <x-icon name="plus-circle"/>
                    </button>
                    </form>
                </div>

                <div class="absolute right-0 top-0">
                    <form wire:submit.prevent="deleteFromCart">
                    <button
                        type="submit"
                        class="-m-2 inline-flex p-2 text-gray-400 hover:text-gray-500"
                    >
                        <span class="sr-only">Remove</span>
                        <x-icon name="x-circle"
                            class="h-5 w-5"
                            aria-hidden="true"
                        />
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
