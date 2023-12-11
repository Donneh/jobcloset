<div>
    <x-main-card-header title="Cart"/>

    <div class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
        <section
            aria-labelledby="cart-heading"
            class="lg:col-span-7"
        >
            <h2 id="cart-heading" class="sr-only">
                Items in your shopping bag
            </h2>

            <livewire:cart-list :items="$items"/>
        </section>

        <div class="lg:col-span-5">
            <section
                aria-labelledby="summary-heading"
                class="rounded-lg bg-gray-50 px-4 py-6 sm:p-6lg:mt-0 lg:p-8 mb-5"
            >
                <h2
                    id="summary-heading"
                    class="text-lg font-medium text-gray-900"
                >
                    Order summary
                </h2>

                <dl class="mt-6 space-y-4">
                    <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                        <dt class="text-base font-medium text-gray-900">
                            Order total
                        </dt>
                        <dd class="text-base font-medium text-gray-900">
                            €{{ $totalPrice }}
                        </dd>
                    </div>
                </dl>

                <section class="mt-4" id="adyen-dropin-container">
                </section>

                <div class="mt-6">
                    <form wire:submit.prevent="placeOrder">
                        <button
                            type="submit"
                            class="w-full bg-black text-white flex text-center justify-center py-4"
                        >
                            Checkout
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
