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
                $query->whereIn('departments.id', $departmentIds); // specify 'departments.id' instead of 'id'
            })->with('attributes')
            ->get();
    }

    public function addToCart($productId)
    {
        $this->dispatch('cart-updated');
        CartService::addToCart($this->productAttributes);

    }

    public function render()
    {
        return view('livewire.shop-list');
    }
}
