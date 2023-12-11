<div>
    <a
        href="{{route("cart.index")}}"
        class="relative hover:opacity-70"
    >
        @if($totalQuantity > 0)
            <div
                class=
                    "absolute bg-violet-500 text-white rounded-full h-5 w-5 flex justify-center items-center text-xs -right-10 top-0"

            >
                {{ $totalQuantity }}
            </div>
        @endif
        <x-icon name="shopping-bag" class="w-8 h-8" />
    </a>
</div>
