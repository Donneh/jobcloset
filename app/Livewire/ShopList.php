<?php

namespace App\Livewire;

use App\Models\Attribute;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ShopList extends Component
{
    public $products;
    public $productAttributes = [];

    public function mount()
    {
        $departmentIds = auth()->user()->departments->pluck('id');

        $this->products = Product::whereDoesntHave('departments')
            ->orWhereHas('departments', function (Builder $query) use ($departmentIds) {
                $query->whereIn('departments.id', $departmentIds);
            })->with('attributes')
            ->get();
    }

    public function addToCart($productId): void
    {
        $this->dispatch('cart-updated');

        if($this->productAttributes) {
            CartService::addToCart($this->productAttributes);
        } else {
            CartService::addToCart([$productId => []]);
        }


    }

    public function render()
    {
        return view('livewire.shop-list');
    }
}
