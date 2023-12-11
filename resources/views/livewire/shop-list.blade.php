<div>
    <x-main-card-header title="Shop"/>

    <div class="mt-6">
        <form wire:submit.prevent="addToCart">
            <div class="-mx-px grid grid-cols-2 border-l border-gray-200 mt-8 sm:mx-0 md:grid-cols-3 lg:grid-cols-4">
                @foreach($products as $product)
                    <div
                        wire:key="{{ $product->id }}"
                        class="relative border-b border-r border-gray-200 p-4 sm:p-6"
                    >
                        <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-200">
                            <img src="storage/{{ $product->image_path }}" alt=""
                                 class="h-full w-full object-cover object-top">
                        </div>
                        <div class="pb-4 pt-10 text-center">
                            <h3 class="text-sm font-medium text-gray-900">
                                {{ $product->name }}
                            </h3>
                            <p class="mt-4 text-base font-medium text-gray-900">
                                € 100
                            </p>
                            <div class="grid grid-cols-1 mt-6">
                                @foreach($product->attributes as $attribute)
                                    <div class="grid grid-cols-2 justify-center items-center my-2"
                                         wire:key="{{ $attribute->id }}">
                                        <label for="productAttributes.{{ $product->id }}.{{ $attribute->name }}">
                                            {{ $attribute->name }}
                                        </label>
                                        <select required
                                                wire:model="productAttributes.{{ $product->id }}.{{ $attribute->name }}">
                                            <option selected>Choose</option>
                                            @foreach($attribute->options as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                            <div class="pb-4 pt-5 text-center">
                                <button
                                    wire:click="addToCart({{ $product->id }})"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    type="button">
                                    Add to bag
                                </button>
                            </div>
                        </div>
                    </div>
            @endforeach
        </form>
    </div>
</div>
