<div>
    <div role="list" class="divide-y divide-gray-200 border-b border-t border-gray-200">
        @if($items)
            @foreach($items as $item)
                <livewire:cart-item :item="$item"/>
            @endforeach

        @else
            <div class="flex justify-center items-center">
                <p class="text-gray-500">Your cart is empty</p>
            </div>
        @endif
    </div>
</div>
